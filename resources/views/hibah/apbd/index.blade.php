@extends('layouts.app')

@section('content')


<div class="page-header">

    <div>
        <h1>Data Hibah</h1>
        <p>Data hibah barang dana APBD dan APBN</p>
    </div>


    <a href="/hibah/apbd/create"
       id="btnTambah"
       class="btn-primary">

        + Tambah

    </a>

</div>





<div class="card-table hibah-dashboard">


    <div class="hibah-topbar">


        <h3>
            Data Hibah Barang
        </h3>



        <div class="hibah-search">

            <input 
                type="text"
                id="searchHibah"
                placeholder="Search"
            >


            <button type="button"
                    id="btnSearch">

                Filter

            </button>


        </div>


    </div>





    {{-- TAB APBD APBN --}}

    <div class="hibah-tabs">


        <button 
            type="button"
            class="hibah-tab active"
            data-sumber="APBD">

            APBD

        </button>



        <button 
            type="button"
            class="hibah-tab"
            data-sumber="APBN">

            APBN

        </button>


    </div>







    <div class="hibah-title">

        DATA HIBAH BARANG DANA 
        <span id="judulDana">
            APBD
        </span>

    </div>







    <div class="table-container">


        <table class="hibah-modern-table">


            <thead>

                <tr>

                    <th>NO</th>
                    <th>KEGIATAN</th>
                    <th>UNIT</th>
                    <th>TAHUN</th>
                    <th>NAMA KELOMPOK</th>
                    <th>DESA</th>
                    <th>KECAMATAN</th>
                    <th>KABUPATEN/KOTA</th>
                    <th>NILAI HIBAH</th>
                    <th>ACTION</th>

                </tr>


            </thead>



            <tbody id="hibahTableBody">


            </tbody>



        </table>


    </div>





</div>



@endsection