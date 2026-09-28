@extends('layouts.app')


@section('content')


<div class="page-header">

    <div>
        <h1>
            Detail Hibah APBD
        </h1>

        <p>
            Informasi lengkap data hibah barang APBD
        </p>
    </div>

</div>



<div class="card">


    {{-- FOTO BARANG --}}

    @if($hibahAPBD->foto)

        <img
            src="{{ asset('storage/'.$hibahAPBD->foto) }}"
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
            <th>Kegiatan</th>
            <td>{{ $hibahAPBD->kegiatan }}</td>
        </tr>


        <tr>
            <th>Unit</th>
            <td>{{ $hibahAPBD->unit }}</td>
        </tr>


        <tr>
            <th>Tahun</th>
            <td>{{ $hibahAPBD->tahun }}</td>
        </tr>


        <tr>
            <th>Nama Kelompok</th>
            <td>{{ $hibahAPBD->nama_kelompok }}</td>
        </tr>


        <tr>
            <th>Desa</th>
            <td>{{ $hibahAPBD->desa }}</td>
        </tr>


        <tr>
            <th>Kecamatan</th>
            <td>{{ $hibahAPBD->kecamatan }}</td>
        </tr>


        <tr>
            <th>Kabupaten/Kota</th>
            <td>{{ $hibahAPBD->kabupaten_kota }}</td>
        </tr>


        <tr>
            <th>Kondisi</th>
            <td>{{ $hibahAPBD->kondisi }}</td>
        </tr>


        <tr>
            <th>Nilai Hibah</th>
            <td>
                Rp {{ number_format($hibahAPBD->nilai_hibah,0,',','.') }}
            </td>
        </tr>


        <tr>
            <th>Dibuat</th>
            <td>
                {{ $hibahAPBD->created_at }}
            </td>
        </tr>


        <tr>
            <th>Diperbarui</th>
            <td>
                {{ $hibahAPBD->updated_at }}
            </td>
        </tr>


    </table>


</div>


@endsection