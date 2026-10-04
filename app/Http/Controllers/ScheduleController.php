<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::paginate(10);

        return view('pages.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();

        return view('pages.schedule.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'hari' => 'required|array|min:1',
            'hari.*' => 'in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'status' => 'required|in:aktif,tidak aktif',
            'doctor_id' => 'required|exists:doctors,id',

            'jam_mulai' => 'required|array',
            'jam_selesai' => 'required|array',
            'kuota' => 'required|array',

            'jam_mulai.*' => 'nullable|date_format:H:i',
            'jam_selesai.*' => 'nullable|date_format:H:i',
            'kuota.*' => 'nullable|integer|min:1|max:100',
        ], [
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',

            'hari.required' => 'Minimal pilih satu hari praktik.',
            'hari.min' => 'Minimal pilih satu hari praktik.',
            
            'jam_mulai.*.required' => 'Jam mulai harus diisi.',
            'jam_mulai.*.date_format' => 'Format jam mulai harus HH:MM.',

            'jam_selesai.*.required' => 'Jam selesai harus diisi.',
            'jam_selesai.*.date_format' => 'Format jam selesai harus HH:MM.',

            'kuota.*.required' => 'Kuota harus diisi.',
            'kuota.*.integer' => 'Kuota harus berupa angka.',
            'kuota.*.min' => 'Kuota minimal 1.',
            'kuota.*.max' => 'Kuota maksimal 100.',

            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',

            'doctor_id.required' => 'Dokter harus dipilih.',
            'doctor_id.exists' => 'Dokter tidak ditemukan.',
        ]);

        $hari = [
            'senin' => 0,
            'selasa' => 1,
            'rabu' => 2,
            'kamis' => 3,
            'jumat' => 4,
            'sabtu' => 5,
            'minggu' => 6,
        ];

        $startWeek = \Carbon\Carbon::parse($request->tanggal)
            ->startOfWeek(\Carbon\Carbon::MONDAY);

        $startCurrentWeek = \Carbon\Carbon::now()
            ->startOfWeek(\Carbon\Carbon::MONDAY);

        if ($startWeek->lt($startCurrentWeek)) {
            return back()
                ->withErrors([
                    'tanggal' => 'Minggu yang dipilih sudah lewat.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $hari) {

            foreach ($request->hari as $day) {

                $tanggal = \Carbon\Carbon::parse($request->tanggal)
                    ->addDays($hari[$day]);

                if ($tanggal->lt(\Carbon\Carbon::today())) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'hari' => 'Hari praktik yang dipilih sudah lewat.'
                    ]);
                }

                $tanggal = $tanggal->toDateString();

                $jamMulai = $request->jam_mulai[$day];
                $jamSelesai = $request->jam_selesai[$day];
                $kuota = $request->kuota[$day];

                if ($jamSelesai <= $jamMulai) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        "jam_selesai.$day" => 'Jam selesai harus lebih besar dari jam mulai.',
                    ]);
                }

                $existing = Schedule::where('doctor_id', $request->doctor_id)
                    ->where('tanggal', $tanggal)
                    ->where('jam_mulai', $jamMulai)
                    ->first();

                if ($existing) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'hari' => "Jadwal untuk hari " . ucfirst($day) . " sudah ada.",
                    ]);
                }

                Schedule::create([
                    'tanggal' => $tanggal,
                    'jam_mulai' => $jamMulai,
                    'jam_selesai' => $jamSelesai,
                    'kuota' => $kuota,
                    'status' => $request->status,
                    'doctor_id' => $request->doctor_id,
                ]);
            }
        });

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil menambahkan jadwal praktik selama satu minggu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedule = Schedule::with('doctor')
            ->findOrFail(decrypt($id));

        $startWeek = \Carbon\Carbon::parse($schedule->tanggal)
            ->startOfWeek(\Carbon\Carbon::MONDAY);

        $endWeek = $startWeek->copy()->addDays(6);

        $weeklySchedules = Schedule::where('doctor_id', $schedule->doctor_id)
            ->whereBetween('tanggal', [
                $startWeek->toDateString(),
                $endWeek->toDateString()
            ])
            ->orderBy('tanggal')
            ->get();

        return view('pages.schedule.show', compact(
            'schedule',
            'weeklySchedules'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));
        $doctors = Doctor::all();

        $weeklySchedules = Schedule::where('doctor_id', $schedule->doctor_id)
            ->whereBetween('tanggal', [
                \Carbon\Carbon::parse($schedule->tanggal)->startOfWeek(),
                \Carbon\Carbon::parse($schedule->tanggal)->endOfWeek()
            ])
            ->get();

        return view('pages.schedule.edit', compact(
            'schedule',
            'weeklySchedules',
            'doctors'
        ));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));

        $request->validate([
            'tanggal' => 'required|date',
            'hari' => 'required|array|min:1',
            'doctor_id' => 'required|exists:doctors,id',
            'jam_mulai.*' => 'nullable|date_format:H:i',
            'jam_selesai.*' => 'nullable|date_format:H:i',
            'kuota.*' => 'nullable|integer|min:1|max:100',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $hari = [
            'senin' => 0,
            'selasa' => 1,
            'rabu' => 2,
            'kamis' => 3,
            'jumat' => 4,
            'sabtu' => 5,
            'minggu' => 6,
        ];

        foreach ($request->hari as $day) {

            if ($request->jam_selesai[$day] <= $request->jam_mulai[$day]) {
                return back()
                    ->withErrors([
                        "jam_selesai.$day" =>
                            'Jam selesai harus lebih besar dari jam mulai.'
                    ])
                    ->withInput();
            }
        }

        $startWeek = \Carbon\Carbon::parse($request->tanggal)
            ->startOfWeek(\Carbon\Carbon::MONDAY);

        $startCurrentWeek = \Carbon\Carbon::now()
            ->startOfWeek(\Carbon\Carbon::MONDAY);

        if ($startWeek->lt($startCurrentWeek)) {
            return back()
                ->withErrors([
                    'tanggal' => 'Minggu yang dipilih sudah lewat.'
                ])
                ->withInput();
        }

        $endWeek = $startWeek->copy()->addDays(6);

        // Ambil semua jadwal dokter pada minggu tersebut
        $weeklySchedules = Schedule::where('doctor_id', $schedule->doctor_id)
            ->whereBetween('tanggal', [
                $startWeek->toDateString(),
                $endWeek->toDateString()
            ])
            ->get();

        // Tanggal yang dipilih admin
        $selectedDates = [];

        foreach ($request->hari as $day) {
            $selectedDates[] = $startWeek->copy()
                ->addDays($hari[$day])
                ->toDateString();
        }

        // Cek jadwal yang sudah memiliki pendaftaran
        foreach ($weeklySchedules as $item) {

            if ($item->registrations()->exists()) {

                $selectedDay = \Carbon\Carbon::parse($item->tanggal)
                    ->locale('id')
                    ->translatedFormat('l');

                // Jadwal yang sudah punya pendaftaran
                // tidak boleh diubah jam, kuota, atau statusnya
                if (in_array($item->tanggal, $selectedDates)) {

                    foreach ($request->hari as $day) {

                        if (
                            $startWeek->copy()
                                ->addDays($hari[$day])
                                ->toDateString() === $item->tanggal
                        ) {

                            $oldJamMulai = \Carbon\Carbon::parse($item->jam_mulai)->format('H:i');
                            $oldJamSelesai = \Carbon\Carbon::parse($item->jam_selesai)->format('H:i');

                            if (
                                $request->jam_mulai[$day] !== $oldJamMulai ||
                                $request->jam_selesai[$day] !== $oldJamSelesai ||
                                (int) $request->kuota[$day] !== (int) $item->kuota ||
                                $request->status !== $item->status
                            ) {

                                return back()
                                    ->withErrors([
                                        'hari' =>
                                            "Jadwal {$selectedDay} tidak dapat diubah karena sudah memiliki pendaftaran."
                                    ])
                                    ->withInput();
                            }
                        }
                    }
                }
            }
        }

        // Jadwal lama berdasarkan tanggal
        $existingByDate = $weeklySchedules->keyBy('tanggal');

        // Proses jadwal yang sudah ada
        foreach ($weeklySchedules as $item) {

            $tanggal = $item->tanggal;

            // Jika sudah punya pendaftaran, jangan dihapus atau diubah
            if ($item->registrations()->exists()) {
                continue;
            }

            // Jika tidak punya pendaftaran dan harinya tidak dipilih lagi,
            // maka hapus jadwal tersebut
            if (!in_array($tanggal, $selectedDates)) {
                $item->delete();
            }
        }

        // Update jadwal lama atau buat jadwal baru
        foreach ($request->hari as $day) {

            $tanggal = $startWeek->copy()
                ->addDays($hari[$day])
                ->toDateString();

            $jamMulai = $request->jam_mulai[$day];
            $jamSelesai = $request->jam_selesai[$day];
            $kuota = $request->kuota[$day];

            // Kalau jadwal pada tanggal tersebut sudah ada
            if (isset($existingByDate[$tanggal])) {

                $item = $existingByDate[$tanggal];

                // Kalau belum punya pendaftaran, boleh diubah
                if (!$item->registrations()->exists()) {

                    $item->update([
                        'doctor_id' => $request->doctor_id,
                        'jam_mulai' => $jamMulai,
                        'jam_selesai' => $jamSelesai,
                        'kuota' => $kuota,
                        'status' => $request->status,
                    ]);
                }

            } else {

                // Kalau belum ada jadwal, buat jadwal baru
                Schedule::create([
                    'doctor_id' => $request->doctor_id,
                    'tanggal' => $tanggal,
                    'jam_mulai' => $jamMulai,
                    'jam_selesai' => $jamSelesai,
                    'kuota' => $kuota,
                    'status' => $request->status,
                ]);
            }
        }

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil mengubah jadwal praktik.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));

        if ($schedule->registrations()->exists()) {
            return redirect()
                ->route('admin.schedule.index')
                ->with('error', 'Jadwal tidak dapat dihapus karena sudah memiliki pendaftaran.');
        }

        $schedule->delete();

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil menghapus data jadwal.');
    }

    /**
     * Get doctors by specialist.
     */
    public function getDoctorsBySpecialist($specialist_id)
    {
        $doctors = Doctor::where('specialist_id', $specialist_id)
            ->where('status', 'aktif')
            ->get();

        return response()->json($doctors);
    }

    /**
     * Get schedules by doctor.
     */
    public function getSchedulesByDoctor($doctor_id)
    {
        $schedules = Schedule::where('doctor_id', $doctor_id)
            ->where('status', 'aktif')
            ->where('tanggal', '>=', today())
            ->where('kuota', '>', 0)
            ->get();

        return response()->json($schedules);
    }
}