<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hibah extends Model
{

    protected $fillable = [

        'kegiatan',
        'unit',
        'tahun',
        'nama_kelompok',
        'desa',
        'kecamatan',
        'kabupaten_kota',
        'nilai_hibah',
        'sumber_dana',
        'foto',
        'kondisi',
        'created_by',
        'updated_by'

    ];


    protected $casts = [

        'nilai_hibah'=>'float'

    ];


    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }


    public function updater()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

}