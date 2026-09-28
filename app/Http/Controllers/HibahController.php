<?php

namespace App\Http\Controllers;

use App\Models\Hibah;
use Illuminate\Http\Request;

class HibahController extends Controller
{

    public function index(Request $r)
    {

        $q = Hibah::query();


        if ($r->sumber_dana) {

            $q->where(
                'sumber_dana',
                $r->sumber_dana
            );

        }


        if ($r->search) {

            $q->where(function($x) use ($r){

                $x->where(
                    'nama_kelompok',
                    'like',
                    '%'.$r->search.'%'
                )

                ->orWhere(
                    'kegiatan',
                    'like',
                    '%'.$r->search.'%'
                );

            });

        }


        if ($r->tahun) {

            $q->where(
                'tahun',
                $r->tahun
            );

        }


        return view('hibah.index',[

            'data'=>$q
                ->latest()
                ->paginate(10)

        ]);

    }





    public function create()
    {
        return view('hibah.form');
    }





    public function store(Request $r)
    {

        $d = $r->validate([

            'kegiatan'=>'required',

            'unit'=>'required',

            'tahun'=>'required',

            'nama_kelompok'=>'required',

            'desa'=>'required',

            'kecamatan'=>'required',

            'kabupaten_kota'=>'required',

            'nilai_hibah'=>'required',

            'sumber_dana'=>'required'

        ]);



        $d['created_by'] = auth()->id();



        Hibah::create($d);



        return redirect('/hibah');

    }





    public function show(Hibah $hibah)
    {

        return view('hibah.show',[

            'h'=>$hibah

        ]);

    }





    public function edit(Hibah $hibah)
    {

        return view('hibah.form',[

            'h'=>$hibah

        ]);

    }





    public function update(Request $r, Hibah $hibah)
    {

        $d = $r->validate([

            'kegiatan'=>'required',

            'unit'=>'required',

            'tahun'=>'required',

            'nama_kelompok'=>'required',

            'desa'=>'required',

            'kecamatan'=>'required',

            'kabupaten_kota'=>'required',

            'nilai_hibah'=>'required',

            'sumber_dana'=>'required'

        ]);



        $d['updated_by'] = auth()->id();



        $hibah->update($d);



        return redirect('/hibah');

    }





    /**
     * AJAX APBD / APBN
     */
    public function ajaxData(Request $r)
    {

        $q = Hibah::query();



        if ($r->sumber_dana) {

            $q->where(

                'sumber_dana',

                $r->sumber_dana

            );

        }



        if ($r->search) {

            $q->where(function($x) use ($r){

                $x->where(

                    'nama_kelompok',

                    'like',

                    '%'.$r->search.'%'

                )

                ->orWhere(

                    'kegiatan',

                    'like',

                    '%'.$r->search.'%'

                );

            });

        }



       return response()->json([
    'data' => $q->latest()->get()
    ]);
}





    public function destroy(Hibah $hibah)
    {

        $hibah->delete();


        return back();

    }

}