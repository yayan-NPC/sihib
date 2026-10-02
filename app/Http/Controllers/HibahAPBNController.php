<?php

namespace App\Http\Controllers;

use App\Models\HibahAPBN;
use Illuminate\Http\Request;

class HibahAPBNController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data = HibahAPBN::latest()->paginate(10);

        return view(
            'hibah.apbn.index',
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
        return view('hibah.apbn.form');
    }



    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

   public function store(Request $request)
{

    $data = $request->validate([

        'kegiatan' =>
        'required|string|max:255',

        'unit' =>
        'required|string|max:255',

        'tahun' =>
        'required|numeric',

        'nama_kelompok' =>
        'required|string|max:255',

        'desa' =>
        'required|string|max:255',

        'kecamatan' =>
        'required|string|max:255',

        'kabupaten_kota' =>
        'required|string|max:255',


        'link_maps' =>
        'nullable|string',

        'nilai_hibah' =>
        'required|numeric',

        'foto' =>
        'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'kondisi' =>
        'required|string'

    ],[

        'required'=>'Kolom :attribute wajib diisi',

        'numeric'=>'Kolom :attribute harus berupa angka',

        'image'=>'File harus berupa gambar',

        'mimes'=>'Format foto harus jpg, jpeg, atau png'

    ]);



    if($request->hasFile('foto')){


        $data['foto'] = 
            $request->file('foto')
            ->store('hibah','public');


    }



    $data['created_by'] = auth()->id();



    HibahAPBN::create($data);



    return redirect('/hibah')

        ->with(
            'success',
            'Data hibah APBN berhasil ditambahkan'
        );

}



    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(HibahAPBN $hibahAPBN)
    {

        return view(
            'hibah.apbn.show',
            compact('hibahAPBN')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(HibahAPBN $hibahAPBN)
    {

        return view(
            'hibah.apbn.form',
            compact('hibahAPBN')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
    Request $request,
    HibahAPBN $hibahAPBN
)
{

    $data = $request->validate([

        'kegiatan' =>
        'required|string|max:255',

        'unit' =>
        'required|string|max:255',

        'tahun' =>
        'required|numeric',

        'nama_kelompok' =>
        'required|string|max:255',

        'desa' =>
        'required|string|max:255',

        'kecamatan' =>
        'required|string|max:255',

        'kabupaten_kota' =>
        'required|string|max:255',

        'link_maps' =>
        'nullable|string',

        'nilai_hibah' =>
        'required|numeric',

        'foto' =>
        'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'kondisi' =>
        'required|string'

    ],[

        'required'=>'Kolom :attribute wajib diisi',

        'numeric'=>'Kolom :attribute harus berupa angka',

        'image'=>'File harus berupa gambar',

        'mimes'=>'Format foto harus jpg, jpeg, atau png'

    ]);



    if($request->hasFile('foto')){


        $data['foto'] = 
            $request->file('foto')
            ->store('hibah','public');


    }



    $data['updated_by'] = auth()->id();



    $hibahAPBN->update($data);



    return redirect('/hibah')

        ->with(
            'success',
            'Data hibah APBN berhasil diperbarui'
        );

}


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(HibahAPBN $hibahAPBN)
    {


        $hibahAPBN->delete();



        return back()

            ->with(
                'success',
                'Data hibah APBN berhasil dihapus'
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

            HibahAPBN::latest()->get()

        );

    }

}