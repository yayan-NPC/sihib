@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <h1>
            {{ isset($hibahAPBD)
                ? 'Edit Data Hibah APBD'
                : 'Tambah Data Hibah APBD'
            }}
        </h1>

        <p>
            {{ isset($hibahAPBD)
                ? 'Perbarui data hibah barang dana APBD'
                : 'Input data hibah barang dana APBD'
            }}
        </p>
    </div>

</div>


<div class="hibah-form-card">

    <form
        method="POST"

        enctype="multipart/form-data"

        action="{{ isset($hibahAPBD)
            ? route('hibah.apbd.update', $hibahAPBD->id)
            : route('hibah.apbd.store')
        }}"

        class="confirm-form"

        data-confirm-type="{{ isset($hibahAPBD)
            ? 'update'
            : 'save'
        }}"

        data-confirm-title="{{ isset($hibahAPBD)
            ? 'Konfirmasi Perubahan'
            : 'Konfirmasi Penyimpanan'
        }}"

        data-confirm-message="{{ isset($hibahAPBD)
            ? 'Yakin ingin mengubah data hibah APBD ini?'
            : 'Yakin ingin menyimpan data hibah APBD ini?'
        }}"

        data-confirm-text="{{ isset($hibahAPBD)
            ? 'Ya, Ubah Data'
            : 'Ya, Simpan Data'
        }}"
    >

        @csrf

        @if(isset($hibahAPBD))
            @method('PUT')
        @endif


        {{-- =========================
             INFORMASI KEGIATAN
        ========================== --}}

        <div class="hibah-form-section">

            <h3>
                Informasi Kegiatan
            </h3>

            <div class="hibah-form-grid">


                {{-- KEGIATAN --}}

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
                            $hibahAPBD->kegiatan ?? ''
                        ) }}"
                        placeholder="Masukkan nama kegiatan"
                    >

                    @error('kegiatan')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- UNIT --}}

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
                            $hibahAPBD->unit ?? ''
                        ) }}"
                        placeholder="Masukkan unit"
                    >

                    @error('unit')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- TAHUN --}}

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
                            $hibahAPBD->tahun ?? ''
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


        {{-- =========================
             DATA PENERIMA
        ========================== --}}

        <div class="hibah-form-section">

            <h3>
                Data Penerima
            </h3>

            <div class="hibah-form-grid">


                {{-- NAMA KELOMPOK --}}

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
                            $hibahAPBD->nama_kelompok ?? ''
                        ) }}"
                        placeholder="Masukkan nama kelompok"
                    >

                    @error('nama_kelompok')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- DESA --}}

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
                            $hibahAPBD->desa ?? ''
                        ) }}"
                        placeholder="Masukkan desa"
                    >

                    @error('desa')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- KECAMATAN --}}

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
                            $hibahAPBD->kecamatan ?? ''
                        ) }}"
                        placeholder="Masukkan kecamatan"
                    >

                    @error('kecamatan')
                        <span class="input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- KABUPATEN / KOTA --}}

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
                            $hibahAPBD->kabupaten_kota ?? ''
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
                    $hibahAPBD->link_maps ?? ''
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


                    @if(isset($hibahAPBD) && $hibahAPBD->foto)

                        <img
                            src="{{ asset('storage/'.$hibahAPBD->foto) }}"
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
                            {{ old('kondisi',$hibahAPBD->kondisi ?? '') == 'Baik'
                            ? 'selected'
                            : '' }}
                        >
                            Baik
                        </option>


                        <option value="Rusak Ringan"
                            {{ old('kondisi',$hibahAPBD->kondisi ?? '') == 'Rusak Ringan'
                            ? 'selected'
                            : '' }}
                        >
                            Rusak Ringan
                        </option>


                        <option value="Rusak Berat"
                            {{ old('kondisi',$hibahAPBD->kondisi ?? '') == 'Rusak Berat'
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

        {{-- =========================
             INFORMASI DANA
        ========================== --}}

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
                            $hibahAPBD->nilai_hibah ?? ''
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


        {{-- =========================
             ACTION BUTTON
        ========================== --}}

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
                {{ isset($hibahAPBD)
                    ? 'Update Data'
                    : 'Simpan Data'
                }}
            </button>

        </div>

    </form>

</div>

@endsection