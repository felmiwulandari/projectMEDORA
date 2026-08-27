<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pasien - MEDORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #3b82f6; 
        }
        .form-card {
            max-width: 450px;
            border-radius: 12px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="card form-card w-100 p-4 shadow-lg border-0 bg-white">
        <h4 class="text-center fw-bold mb-4 text-uppercase" style="letter-spacing: 1px;">Form Pasien</h4>

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase">NIK</label>
                <input type="text" name="nik" class="form-control" maxlength="24" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="" disabled selected>PILIH JENIS KELAMIN</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small text-uppercase">No HP</label>
                <input type="text" name="no_hp" class="form-control" maxlength="64" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold small text-uppercase">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 text-uppercase">
                Lanjut
            </button>
        </form>
    </div>

</body>
</html>