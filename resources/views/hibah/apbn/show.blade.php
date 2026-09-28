@extends('layouts.app')


@section('content')


<div class="page-header">

    <div>
        <h1>
            Detail Hibah APBN
        </h1>

        <p>
            Informasi lengkap data hibah barang APBD
        </p>
    </div>

</div>



<div class="card">


    {{-- FOTO BARANG --}}

    @if($hibahAPBN->foto)

        <img
            src="{{ asset('storage/'.$hibahAPBN->foto) }}"
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
            <td>{{ $hibahAPBN->kegiatan }}</td>
        </tr>


        <tr>
            <th>Unit</th>
            <td>{{ $hibahAPBN->unit }}</td>
        </tr>


        <tr>
            <th>Tahun</th>
            <td>{{ $hibahAPBN->tahun }}</td>
        </tr>


        <tr>
            <th>Nama Kelompok</th>
            <td>{{ $hibahAPBN->nama_kelompok }}</td>
        </tr>


        <tr>
            <th>Desa</th>
            <td>{{ $hibahAPBN->desa }}</td>
        </tr>


        <tr>
            <th>Kecamatan</th>
            <td>{{ $hibahAPBN->kecamatan }}</td>
        </tr>


        <tr>
            <th>Kabupaten/Kota</th>
            <td>{{ $hibahAPBN->kabupaten_kota }}</td>
        </tr>


        <tr>
            <th>Kondisi</th>
            <td>{{ $hibahAPBN->kondisi }}</td>
        </tr>


        <tr>
            <th>Nilai Hibah</th>
            <td>
                Rp {{ number_format($hibahAPBN->nilai_hibah,0,',','.') }}
            </td>
        </tr>


        <tr>
            <th>Dibuat</th>
            <td>
                {{ $hibahAPBN->created_at }}
            </td>
        </tr>


        <tr>
            <th>Diperbarui</th>
            <td>
                {{ $hibahAPBN->updated_at }}
            </td>
        </tr>


    </table>


</div>


@endsection