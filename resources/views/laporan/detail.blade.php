@extends('layouts.app')

@section('content')


<div class="page-header">

    <div>

        <h1>
            Laporan Hibah Tahun {{ $tahun }}
        </h1>

        <p>
            Data hibah berdasarkan tahun
        </p>

    </div>

</div>





{{-- TAB SUMBER DANA --}}

<div class="laporan-tabs">

    <button 
        class="laporan-tab active"
        onclick="showLaporan('apbd', this)">
        APBD
    </button>


    <button 
        class="laporan-tab"
        onclick="showLaporan('apbn', this)">
        APBN
    </button>

</div>







{{-- =========================
    DATA APBD
========================= --}}


<div 
class="card-table laporan-data" 
id="apbd">


<div class="hibah-title">

    DATA HIBAH BARANG DANA 
    <span>
        APBD TAHUN {{ $tahun }}
    </span>

</div>



<div class="table-container">


<table class="hibah-modern-table">


<thead>

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


</tr>

</thead>



<tbody>


@forelse($apbd as $i=>$item)


<tr>


<td>
{{ $i+1 }}
</td>


<td>
{{ $item->kegiatan }}
</td>


<td>
{{ $item->unit }}
</td>


<td>
{{ $item->tahun }}
</td>


<td>
{{ $item->nama_kelompok }}
</td>


<td>
{{ $item->desa }}
</td>


<td>
{{ $item->kecamatan }}
</td>


<td>
{{ $item->kabupaten_kota }}
</td>


<td>
Rp {{ number_format($item->nilai_hibah) }}
</td>


</tr>


@empty


<tr>

<td colspan="9">
Data APBD tidak tersedia
</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>










{{-- =========================
    DATA APBN
========================= --}}


<div 
class="card-table laporan-data" 
id="apbn"
style="display:none;">



<div class="hibah-title">

    DATA HIBAH BARANG DANA 
    <span>
        APBN TAHUN {{ $tahun }}
    </span>

</div>




<div class="table-container">


<table class="hibah-modern-table">


<thead>

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


</tr>

</thead>



<tbody>


@forelse($apbn as $i=>$item)


<tr>


<td>
{{ $i+1 }}
</td>


<td>
{{ $item->kegiatan }}
</td>


<td>
{{ $item->unit }}
</td>


<td>
{{ $item->tahun }}
</td>


<td>
{{ $item->nama_kelompok }}
</td>


<td>
{{ $item->desa }}
</td>


<td>
{{ $item->kecamatan }}
</td>


<td>
{{ $item->kabupaten_kota }}
</td>


<td>
Rp {{ number_format($item->nilai_hibah) }}
</td>


</tr>


@empty


<tr>

<td colspan="9">
Data APBN tidak tersedia
</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>







<script>

function showLaporan(type, button){


    document
    .querySelectorAll('.laporan-data')
    .forEach(function(table){

        table.style.display = 'none';

    });



    document
    .getElementById(type)
    .style.display = 'block';




  document
.querySelectorAll('.laporan-tab')
.forEach(function(btn){

    btn.classList.remove('active');

});



    button.classList.add('active');


}


</script>


@endsection