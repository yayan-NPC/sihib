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
        Schema::table('hibah_apbns', function (Blueprint $table) {

            $table->string('foto')
                ->nullable()
                ->after('nilai_hibah');


            $table->string('kondisi')
                ->default('Baik')
                ->after('foto');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hibah_apbns', function (Blueprint $table) {

            $table->dropColumn([
                'foto',
                'kondisi'
            ]);

        });
    }
};