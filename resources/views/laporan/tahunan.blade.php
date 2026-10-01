@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Laporan Tahunan</h1>
        <p>Histori laporan hibah berdasarkan tahun</p>
    </div>
</div>

<div class="card-table laporan-card">

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Keterangan</th>
                <th>Total Dana Hibah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @php
            $tahunList = collect(
                \App\Models\HibahAPBD::pluck('tahun')
            )->merge(
                \App\Models\HibahAPBN::pluck('tahun')
            )->unique()->sortDesc();
            $tahunList = collect(
            \App\Models\HibahAPBD::pluck('tahun')
            )->merge(
                \App\Models\HibahAPBN::pluck('tahun')
            )
            ->unique()
            ->sortDesc()
            ->values();
        @endphp

        @foreach($tahunList as $i => $tahun)

@php

$totalTahun =
    \App\Models\HibahAPBD::where('tahun',$tahun)
    ->sum('nilai_hibah')
    +
    \App\Models\HibahAPBN::where('tahun',$tahun)
    ->sum('nilai_hibah');

@endphp


<tr>

    <td>
        {{ $i+1 }}
    </td>


    <td>
        {{ $tahun }}
    </td>


    <td>
        Laporan Hibah Tahun {{ $tahun }}
    </td>


    <td>
        Rp {{ number_format($totalTahun,0,',','.') }}
    </td>


    <td>

        <a 
        class="btn-detail" 
        href="{{ route('laporan.tahunan.detail',$tahun) }}">

            Lihat

        </a>

    </td>


</tr>


@endforeach
        </tbody>
    </table>

</div>

@endsection
