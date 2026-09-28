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
        Schema::create('hibah_apbds', function (Blueprint $table) {

            $table->id();

            $table->string('kegiatan');
            $table->string('unit');
            $table->integer('tahun');

            $table->string('nama_kelompok');

            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');

            $table->decimal('nilai_hibah', 15, 2);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hibah_apbds');
    }
};