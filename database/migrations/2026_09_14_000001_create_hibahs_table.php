<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('hibahs', function(Blueprint $table){

            $table->id();

            $table->string('kegiatan');
            $table->string('unit');
            $table->integer('tahun');

            $table->string('nama_kelompok');

            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');

            $table->decimal('nilai_hibah',15,2);

            // Tambahan untuk membedakan APBD dan APBN
            $table->enum('sumber_dana', [
                'APBD',
                'APBN'
            ])->default('APBD');

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('hibahs');
    }
};