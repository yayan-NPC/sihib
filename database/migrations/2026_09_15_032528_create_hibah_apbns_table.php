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
        Schema::create('hibah_apbns', function (Blueprint $table) {

            $table->id();

            // Informasi Kegiatan
            $table->string('kegiatan');
            $table->string('unit');
            $table->integer('tahun');

            // Data Penerima
            $table->string('nama_kelompok');

            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');

            // Link Google Maps
            $table->text('link_maps')->nullable();

            // Informasi Dana
            $table->decimal('nilai_hibah', 15, 2);

            // User Tracking
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Timestamp & Soft Delete
            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hibah_apbns');
    }
};