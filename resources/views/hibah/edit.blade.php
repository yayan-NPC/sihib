@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <h1>
            Edit Data Hibah
        </h1>

        <p>
            Perbarui informasi data hibah {{ strtoupper(request()->segment(2)) }}
        </p>
    </div>

</div>



<div class="hibah-form-card">


<form 
method="POST"
action="{{ request()->segment(2)=='apbd'
? route('hibah.apbd.update',$hibah->id)
: route('hibah.apbn.update',$hibah->id)
}}"


@csrf
@method('PUT')



<div class="hibah-form-grid">



<div class="hibah-form-group">

<label>
Kegiatan
</label>

<input 
type="text"
name="kegiatan"
value="{{ old('kegiatan',$hibah->kegiatan) }}"
>


@error('kegiatan')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Unit
</label>

<input 
type="text"
name="unit"
value="{{ old('unit',$hibah->unit) }}"
>


@error('unit')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Tahun
</label>


<input 
type="number"
name="tahun"
value="{{ old('tahun',$hibah->tahun) }}"
>


@error('tahun')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Nama Kelompok
</label>


<input 
type="text"
name="nama_kelompok"
value="{{ old('nama_kelompok',$hibah->nama_kelompok) }}"
>


@error('nama_kelompok')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Desa
</label>


<input 
type="text"
name="desa"
value="{{ old('desa',$hibah->desa) }}"
>


@error('desa')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Kecamatan
</label>


<input 
type="text"
name="kecamatan"
value="{{ old('kecamatan',$hibah->kecamatan) }}"
>


@error('kecamatan')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Kabupaten/Kota
</label>


<input 
type="text"
name="kabupaten_kota"
value="{{ old('kabupaten_kota',$hibah->kabupaten_kota) }}"
>


@error('kabupaten_kota')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>





<div class="hibah-form-group">

<label>
Nilai Hibah
</label>


<input 
type="number"
name="nilai_hibah"
value="{{ old('nilai_hibah',$hibah->nilai_hibah) }}"
>


@error('nilai_hibah')
<small class="text-danger">
{{ $message }}
</small>
@enderror


</div>



</div>





<div class="hibah-form-action">


<a 
href="{{ route('hibah.index') }}"
class="btn-hibah-cancel">

Kembali

</a>




<button 
type="submit"
class="btn-hibah-save">

Simpan Perubahan

</button>


</div>



</form>


</div>


@endsection