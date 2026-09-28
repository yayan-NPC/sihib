<?php

namespace App\Http\Controllers;

use App\Models\HibahAPBD;
use App\Models\HibahAPBN;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $jumlah =
            HibahAPBD::count()
            +
            HibahAPBN::count();


        $total =
            HibahAPBD::sum('nilai_hibah')
            +
            HibahAPBN::sum('nilai_hibah');


        $totalAPBD =
            HibahAPBD::sum('nilai_hibah');


        $totalAPBN =
            HibahAPBN::sum('nilai_hibah');


        $jumlahPenerima =
            HibahAPBD::distinct('nama_kelompok')->count('nama_kelompok')
            +
            HibahAPBN::distinct('nama_kelompok')->count('nama_kelompok');



        // Statistik per tahun

        $tahun = DB::table('hibah_apbds')
            ->select(
                'tahun',
                DB::raw('count(*) as jumlah')
            )
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();



// Data grafik 5 tahun terakhir

$grafikTahun = [];


$semuaTahun = collect(

    HibahAPBD::pluck('tahun')

)
->merge(

    HibahAPBN::pluck('tahun')

)
->unique()
->sortDesc()
->take(5)
->sort();



foreach($semuaTahun as $year){


    $grafikTahun[$year] =

        HibahAPBD::where('tahun',$year)
        ->sum('nilai_hibah')

        +

        HibahAPBN::where('tahun',$year)
        ->sum('nilai_hibah');


}


        // Data terbaru

        $hibahTerbaru = collect();


        $hibahTerbaru = $hibahTerbaru
            ->merge(
                HibahAPBD::latest()->take(5)->get()
            )
            ->merge(
                HibahAPBN::latest()->take(5)->get()
            )
            ->sortByDesc('created_at')
            ->take(10);



        return view('dashboard.index', [

            'jumlah' => $jumlah,

            'total' => $total,

            'totalAPBD' => $totalAPBD,

            'totalAPBN' => $totalAPBN,

            'jumlahPenerima' => $jumlahPenerima,

            'tahun' => $tahun,

            'grafikTahun' => collect($grafikTahun),

            'hibahTerbaru' => $hibahTerbaru

        ]);

    }
}