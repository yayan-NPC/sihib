<?php

namespace App\Http\Controllers;


use App\Models\HibahAPBD;
use App\Models\HibahAPBN;


class LaporanController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | LAPORAN TAHUNAN
    |--------------------------------------------------------------------------
    */

    public function tahunan()
    {
        return view('laporan.tahunan');
    }






    /*
    |--------------------------------------------------------------------------
    | HALAMAN PREVIEW EXCEL
    |--------------------------------------------------------------------------
    */

    public function detailTahunan($tahun)
    {

        $apbd = HibahAPBD::where("tahun", $tahun)->get();

        $apbn = HibahAPBN::where("tahun", $tahun)->get();

        return view(
            "laporan.detail",
            compact(
                "tahun",
                "apbd",
                "apbn"
            )
        );

    }



    public function excelPage()
{

    $sumber = request('sumber','APBD');


    $data = $this->getData(
        $sumber,
        request('urutan','desc'),
        request('kegiatan')
    );

    

    $kegiatan = $this->getKegiatan($sumber);



    return view(
        'laporan.excel',
        compact(
            'data',
            'sumber',
            'kegiatan'
        )
    );

}






    /*
    |--------------------------------------------------------------------------
    | HALAMAN PREVIEW WORD
    |--------------------------------------------------------------------------
    */

   public function wordPage()
{

    $sumber = request('sumber','APBD');


    $data = $this->getData(
        $sumber,
        request('urutan','desc'),
        request('kegiatan')
    );


    $kegiatan = $this->getKegiatan($sumber);



    return view(
        'laporan.word',
        compact(
            'data',
            'sumber',
            'kegiatan'
        )
    );

}








    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL
    |--------------------------------------------------------------------------
    */

    public function excel($sumber)
    {


        $data = $this->getData(
            $sumber,
            request('urutan','desc'),
            request('kegiatan')
        );



        if($data->isEmpty()){


            return redirect()
                ->route('laporan.excel')
                ->with(
                    'error',
                    'Data '.$sumber.' belum tersedia untuk export'
                );

        }





        $filename =
            'laporan_hibah_'
            . strtolower($sumber)
            . '.xls';






        $content =
        "No\tKegiatan\tUnit\tTahun\tNama Kelompok\tDesa\tKecamatan\tKabupaten/Kota\tNilai Hibah\n";





        foreach($data as $i=>$item){


            $content .=

                ($i+1)."\t".
                $item->kegiatan."\t".
                $item->unit."\t".
                $item->tahun."\t".
                $item->nama_kelompok."\t".
                $item->desa."\t".
                $item->kecamatan."\t".
                $item->kabupaten_kota."\t".
                $item->nilai_hibah."\n";


        }






        return response($content)

            ->header(
                'Content-Type',
                'application/vnd.ms-excel'
            )

            ->header(
                'Content-Disposition',
                'attachment; filename="'.$filename.'"'
            );


    }









    /*
    |--------------------------------------------------------------------------
    | EXPORT WORD
    |--------------------------------------------------------------------------
    */


  public function word($sumber)
{


    $data = $this->getData(
        $sumber,
        request('urutan','desc'),
        request('kegiatan')
    );



    if($data->isEmpty()){


        return redirect()
            ->route('laporan.word')
            ->with(
                'error',
                'Data '.$sumber.' belum tersedia untuk export'
            );

    }







        $html = '

        <html>

        <head>

        <meta charset="UTF-8">


        <style>

        body{
            font-family:Arial;
        }


        h2{
            text-align:center;
        }


        table{

            width:100%;
            border-collapse:collapse;

        }


        th{

            background:#D9EBDD;
            padding:8px;

        }


        td{

            padding:8px;

        }


        th,td{

            border:1px solid black;

        }


        </style>


        </head>



        <body>



        <h2>
        DATA HIBAH BARANG DANA '.e($sumber).'
        </h2>




        <table>



        <tr>

        <th>No</th>

        <th>Kegiatan</th>

        <th>Unit</th>

        <th>Tahun</th>

        <th>Nama Kelompok</th>

        <th>Desa</th>

        <th>Kecamatan</th>

        <th>Kabupaten/Kota</th>

        <th>Nilai Hibah</th>

        </tr>';





        foreach($data as $i=>$item){


            $html .= '

            <tr>


            <td>'.($i+1).'</td>

            <td>'.e($item->kegiatan).'</td>

            <td>'.e($item->unit).'</td>

            <td>'.e($item->tahun).'</td>

            <td>'.e($item->nama_kelompok).'</td>

            <td>'.e($item->desa).'</td>

            <td>'.e($item->kecamatan).'</td>

            <td>'.e($item->kabupaten_kota).'</td>

            <td>'.number_format($item->nilai_hibah).'</td>


            </tr>';

        }





        $html .= '

        </table>


        </body>

        </html>';







        return response($html)

            ->header(
                'Content-Type',
                'application/msword'
            )

            ->header(
                'Content-Disposition',
                'attachment; filename="laporan_hibah_'.$sumber.'.doc"'
            );


    }









    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA
    |--------------------------------------------------------------------------
    */


   private function getData(
    $sumber,
    $urutan = 'desc',
    $kegiatan = null
)

{


    $sumber = strtoupper($sumber);



    $query = match($sumber){


        'APBD' => HibahAPBD::query(),


        'APBN' => HibahAPBN::query(),


        default => abort(404)

    };

        if($kegiatan){

        $query->where(
            'kegiatan',
            $kegiatan
        );

    }

    $query->orderBy(
        'tahun',
        $urutan == 'asc' ? 'asc' : 'desc'
    );



    return $query->get();


    
}

    private function getKegiatan($sumber)
    {

        $query = match(strtoupper($sumber)){


            'APBD' => HibahAPBD::query(),

            'APBN' => HibahAPBN::query(),

            default => abort(404)

        };


        return $query
            ->select('kegiatan')
            ->distinct()
            ->orderBy('kegiatan')
            ->pluck('kegiatan');

    }

}