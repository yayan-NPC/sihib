@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <h1>
            {{ isset($hibahAPBN)
                ? 'Edit Data Hibah APBN'
                : 'Tambah Data Hibah APBN'
            }}
        </h1>

        <p>
            {{ isset($hibahAPBN)
                ? 'Perbarui data hibah barang dana APBN'
                : 'Input data hibah barang dana APBN'
            }}
        </p>
    </div>

</div>


<div class="hibah-form-card">

    <form
        method="POST"

        enctype="multipart/form-data"

        action="{{ isset($hibahAPBN)
            ? route('hibah.apbn.update', $hibahAPBN->id)
            : route('hibah.apbn.store')
        }}"

        class="confirm-form"

        data-confirm-type="{{ isset($hibahAPBN)
            ? 'update'
            : 'save'
        }}"

        data-confirm-title="{{ isset($hibahAPBN)
            ? 'Konfirmasi Perubahan'
            : 'Konfirmasi Penyimpanan'
        }}"

        data-confirm-message="{{ isset($hibahAPBN)
            ? 'Yakin ingin mengubah data hibah APBN ini?'
            : 'Yakin ingin menyimpan data hibah APBN ini?'
        }}"

        data-confirm-text="{{ isset($hibahAPBN)
            ? 'Ya, Ubah Data'
            : 'Ya, Simpan Data'
        }}"
    >

        @csrf

        @if(isset($hibahAPBN))
            @method('PUT')
        @endif


        {{-- INFORMASI KEGIATAN --}}

        <div class="hibah-form-section">

            <h3>
                Informasi Kegiatan
            </h3>

            <div class="hibah-form-grid">


                <div class="hibah-form-group">

                    <label for="kegiatan">
                        Kegiatan
                    </label>

                    <input
                        type="text"
                        id="kegiatan"
                        name="kegiatan"
                        class="@error('kegiatan') form-error @enderror"
                        value="{{ old(
                            'kegiatan',
                            $hibahAPBN->kegiatan ?? ''
                        ) }}"
                        placeholder="Masukkan nama kegiatan"
                    >

                    @error('kegiatan')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="hibah-form-group">

                    <label for="unit">
                        Unit
                    </label>

                    <input
                        type="text"
                        id="unit"
                        name="unit"
                        class="@error('unit') form-error @enderror"
                        value="{{ old(
                            'unit',
                            $hibahAPBN->unit ?? ''
                        ) }}"
                        placeholder="Masukkan unit"
                    >

                    @error('unit')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="hibah-form-group">

                    <label for="tahun">
                        Tahun
                    </label>

                    <input
                        type="number"
                        id="tahun"
                        name="tahun"
                        min="2000"
                        max="{{ date('Y') + 5 }}"
                        class="@error('tahun') form-error @enderror"
                        value="{{ old(
                            'tahun',
                            $hibahAPBN->tahun ?? ''
                        ) }}"
                        placeholder="Contoh: {{ date('Y') }}"
                    >

                    @error('tahun')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>


        {{-- DATA PENERIMA --}}

        <div class="hibah-form-section">

            <h3>
                Data Penerima
            </h3>

            <div class="hibah-form-grid">


                <div class="hibah-form-group">

                    <label for="nama_kelompok">
                        Nama Kelompok
                    </label>

                    <input
                        type="text"
                        id="nama_kelompok"
                        name="nama_kelompok"
                        class="@error('nama_kelompok') form-error @enderror"
                        value="{{ old(
                            'nama_kelompok',
                            $hibahAPBN->nama_kelompok ?? ''
                        ) }}"
                        placeholder="Masukkan nama kelompok"
                    >

                    @error('nama_kelompok')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="hibah-form-group">

                    <label for="desa">
                        Desa
                    </label>

                    <input
                        type="text"
                        id="desa"
                        name="desa"
                        class="@error('desa') form-error @enderror"
                        value="{{ old(
                            'desa',
                            $hibahAPBN->desa ?? ''
                        ) }}"
                        placeholder="Masukkan desa"
                    >

                    @error('desa')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="hibah-form-group">

                    <label for="kecamatan">
                        Kecamatan
                    </label>

                    <input
                        type="text"
                        id="kecamatan"
                        name="kecamatan"
                        class="@error('kecamatan') form-error @enderror"
                        value="{{ old(
                            'kecamatan',
                            $hibahAPBN->kecamatan ?? ''
                        ) }}"
                        placeholder="Masukkan kecamatan"
                    >

                    @error('kecamatan')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="hibah-form-group">

                    <label for="kabupaten_kota">
                        Kabupaten/Kota
                    </label>

                    <input
                        type="text"
                        id="kabupaten_kota"
                        name="kabupaten_kota"
                        class="@error('kabupaten_kota') form-error @enderror"
                        value="{{ old(
                            'kabupaten_kota',
                            $hibahAPBN->kabupaten_kota ?? ''
                        ) }}"
                        placeholder="Masukkan kabupaten/kota"
                    >

                    @error('kabupaten_kota')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>
            {{-- LINK GOOGLE MAPS --}}

        <div class="hibah-form-group full">

            <label for="link_maps">
                Link Google Maps
            </label>

            <input
                type="text"
                id="link_maps"
                name="link_maps"
                class="@error('link_maps') form-error @enderror"
                value="{{ old(
                    'link_maps',
                    $hibahAPBN->link_maps ?? ''
                ) }}"
                placeholder="Tempel link Google Maps"
            >

            @error('link_maps')
                <span class="input-error">
                    {{ $message }}
                </span>
            @enderror

        </div>
            </div>

        </div>


        {{-- =========================
            INFORMASI BARANG
        ========================== --}}

        <div class="hibah-form-section">

            <h3>
                Informasi Barang
            </h3>


            <div class="hibah-form-grid">


                {{-- FOTO --}}

                <div class="hibah-form-group">

                    <label for="foto">
                        Foto Barang
                    </label>


                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        accept="image/*"
                        class="@error('foto') form-error @enderror"
                    >


                    @if(isset($hibahAPBN) && $hibahAPBN->foto)

                        <img
                            src="{{ asset('storage/'.$hibahAPBN->foto) }}"
                            width="100"
                            style="margin-top:10px;border-radius:8px;"
                        >

                    @endif


                    @error('foto')

                        <span class="input-error">
                            {{ $message }}
                        </span>

                    @enderror


                </div>




                {{-- KONDISI --}}

                <div class="hibah-form-group">

                    <label for="kondisi">
                        Kondisi Barang
                    </label>


                    <select
                        id="kondisi"
                        name="kondisi"
                    >


                        <option value="Baik"
                            {{ old('kondisi',$hibahAPBN->kondisi ?? '') == 'Baik'
                            ? 'selected'
                            : '' }}
                        >
                            Baik
                        </option>


                        <option value="Rusak Ringan"
                            {{ old('kondisi',$hibahAPBN->kondisi ?? '') == 'Rusak Ringan'
                            ? 'selected'
                            : '' }}
                        >
                            Rusak Ringan
                        </option>


                        <option value="Rusak Berat"
                            {{ old('kondisi',$hibahAPBN->kondisi ?? '') == 'Rusak Berat'
                            ? 'selected'
                            : '' }}
                        >
                            Rusak Berat
                        </option>


                    </select>


                    @error('kondisi')

                        <span class="input-error">
                            {{ $message }}
                        </span>

                    @enderror


                </div>


            </div>

        </div>

        {{-- INFORMASI DANA --}}

        <div class="hibah-form-section">

            <h3>
                Informasi Dana
            </h3>

            <div class="hibah-form-grid">

                <div class="hibah-form-group full">

                    <label for="nilai_hibah">
                        Nilai Hibah
                    </label>

                    <input
                        type="number"
                        id="nilai_hibah"
                        name="nilai_hibah"
                        min="0"
                        step="0.01"
                        inputmode="decimal"
                        class="@error('nilai_hibah') form-error @enderror"
                        value="{{ old(
                            'nilai_hibah',
                            $hibahAPBN->nilai_hibah ?? ''
                        ) }}"
                        placeholder="Masukkan nilai hibah"
                    >

                    @error('nilai_hibah')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ACTION --}}

        <div class="hibah-form-action">

            <a
                href="{{ route('hibah.index') }}"
                class="btn-hibah-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-hibah-save"
            >
                {{ isset($hibahAPBN)
                    ? 'Update Data'
                    : 'Simpan Data'
                }}
            </button>

        </div>

    </form>

</div>

@endsection