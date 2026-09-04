<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
<<<<<<< HEAD
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained('specialist')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->date('tanggal_daftar');
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'ditolak'])->default('menunggu');
            $table->text('keluhan');
            $table->timestamps();
        });
=======
       Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
        $table->date('tanggal_daftar');
        $table->enum('status', ['menunggu', 'Di konfirmasi', 'Di tolak'])->default('menunggu'); 
        $table->text('keluhan');
        $table->timestamps();
});
>>>>>>> origin/fitur-registration
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
