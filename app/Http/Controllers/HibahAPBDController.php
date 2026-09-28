<?php

namespace App\Http\Controllers;

use App\Models\HibahAPBD;
use Illuminate\Http\Request;

class HibahAPBDController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data = HibahAPBD::latest()->paginate(10);

        return view(
            'hibah.apbd.index',
            compact('data')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('hibah.apbd.form');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

   public function store(Request $request)
{

    $data = $request->validate([

        'kegiatan'
            => 'required|string|max:255',

        'unit'
            => 'required|string|max:255',

        'tahun'
            => 'required|numeric',

        'nama_kelompok'
            => 'required|string|max:255',

        'desa'
            => 'required|string|max:255',

        'kecamatan'
            => 'required|string|max:255',

        'kabupaten_kota'
            => 'required|string|max:255',

        'nilai_hibah'
            => 'required|numeric',

        'foto'
            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'kondisi'
            => 'required|string'

    ],[

        'required'
            => 'Kolom :attribute wajib diisi',

        'numeric'
            => 'Kolom :attribute harus berupa angka',

        'image'
            => 'File harus berupa gambar',

        'mimes'
            => 'Format foto harus jpg, jpeg, atau png'

    ]);



    // UPLOAD FOTO

    if($request->hasFile('foto')){


        $data['foto'] = 
            $request->file('foto')
            ->store('hibah','public');


    }



    $data['created_by'] = auth()->id();



    HibahAPBD::create($data);



    return redirect('/hibah')

        ->with(
            'success',
            'Data hibah APBD berhasil ditambahkan'
        );

}

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(HibahAPBD $hibahAPBD)
    {

        return view(
            'hibah.apbd.show',
            compact('hibahAPBD')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(HibahAPBD $hibahAPBD)
    {

        return view(
            'hibah.apbd.form',
            compact('hibahAPBD')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

   public function update(
    Request $request,
    HibahAPBD $hibahAPBD
)
{

    $data = $request->validate([

        'kegiatan'
            => 'required|string|max:255',

        'unit'
            => 'required|string|max:255',

        'tahun'
            => 'required|numeric',

        'nama_kelompok'
            => 'required|string|max:255',

        'desa'
            => 'required|string|max:255',

        'kecamatan'
            => 'required|string|max:255',

        'kabupaten_kota'
            => 'required|string|max:255',

        'nilai_hibah'
            => 'required|numeric',

        'foto'
            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'kondisi'
            => 'required|string'


    ],[

        'required'
            => 'Kolom :attribute wajib diisi',

        'numeric'
            => 'Kolom :attribute harus berupa angka',

        'image'
            => 'File harus berupa gambar',

        'mimes'
            => 'Format foto harus jpg, jpeg, atau png'

    ]);



    // GANTI FOTO JIKA UPLOAD BARU

    if($request->hasFile('foto')){


        $data['foto'] = 
            $request->file('foto')
            ->store('hibah','public');


    }



    $data['updated_by'] = auth()->id();



    $hibahAPBD->update($data);



    return redirect('/hibah')

        ->with(
            'success',
            'Data hibah APBD berhasil diperbarui'
        );

}





    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(HibahAPBD $hibahAPBD)
    {


        $hibahAPBD->delete();



        return back()

            ->with(
                'success',
                'Data hibah APBD berhasil dihapus'
            );

    }





    /*
    |--------------------------------------------------------------------------
    | AJAX DATA
    |--------------------------------------------------------------------------
    */

    public function ajaxData()
    {

        return response()->json(

            HibahAPBD::latest()->get()

        );

    }

}