@extends('layouts.app')


@section('content')


<div class="page-header">

    <div>

        <h1>
            Detail Hibah
        </h1>

        <p>
            Informasi lengkap data hibah barang
        </p>

    </div>

</div>



<div class="card">


    @if($h->foto)

        <img
            src="{{ asset('storage/'.$h->foto) }}"
            style="
                width:300px;
                height:300px;
                object-fit:contain;
                border-radius:15px;
                background:#f5f5f5;
                margin-bottom:25px;
            "
        >

    @else

        <div style="
            width:300px;
            height:300px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f5f5f5;
            border-radius:15px;
            margin-bottom:25px;
        ">

            Foto tidak tersedia

        </div>

    @endif




    <table>


        <tr>
            <th>Sumber Dana</th>
            <td>
                {{ $h->sumber_dana }}
            </td>
        </tr>


        <tr>
            <th>Kegiatan</th>
            <td>
                {{ $h->kegiatan }}
            </td>
        </tr>


        <tr>
            <th>Unit</th>
            <td>
                {{ $h->unit }}
            </td>
        </tr>


        <tr>
            <th>Tahun</th>
            <td>
                {{ $h->tahun }}
            </td>
        </tr>


        <tr>
            <th>Nama Kelompok</th>
            <td>
                {{ $h->nama_kelompok }}
            </td>
        </tr>


        <tr>
            <th>Desa</th>
            <td>
                {{ $h->desa }}
            </td>
        </tr>


        <tr>
            <th>Kecamatan</th>
            <td>
                {{ $h->kecamatan }}
            </td>
        </tr>


        <tr>
            <th>Kabupaten/Kota</th>
            <td>
                {{ $h->kabupaten_kota }}
            </td>
        </tr>


        <tr>
            <th>Kondisi</th>
            <td>
                {{ $h->kondisi }}
            </td>
        </tr>


        <tr>
            <th>Nilai Hibah</th>
            <td>
                Rp {{ number_format($h->nilai_hibah,0,',','.') }}
            </td>
        </tr>


        <tr>
            <th>Dibuat</th>
            <td>
                {{ $h->created_at }}
            </td>
        </tr>


        <tr>
            <th>Diperbarui</th>
            <td>
                {{ $h->updated_at }}
            </td>
        </tr>


    </table>


</div>


@endsection