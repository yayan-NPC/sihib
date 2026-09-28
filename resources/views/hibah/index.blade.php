@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <h1>
            Data Hibah
        </h1>

        <p>
            Data hibah barang dana APBD dan APBN
        </p>
    </div>

</div>


<div class="card-table hibah-dashboard">


<div class="hibah-topbar">

    <div></div>

    <div class="hibah-topbar-actions">


        <div class="tahun-filter">

    <button 
    type="button"
    class="tahun-button"
    id="tahunButton">


    <span class="tahun-label">
        Urutan Tahun
    </span>


    <span class="arrow">

        <x-heroicon-o-chevron-down />

    </span>


</button>


    <div 
        class="tahun-menu"
        id="tahunMenu">


        <button data-value="desc">

            Terbaru

        </button>



        <button data-value="asc">

            Terlama

        </button>


    </div>


</div>



        <button
            type="button"
            id="btnYearSummary"
            class="btn-year-summary"
        >
            Rekap Tahun
        </button>



        <a
            href="{{ route('hibah.apbd.create') }}"
            id="btnTambahHibah"
            class="btn-primary"
        >
            + Tambah
        </a>


    </div>

</div>



<div class="hibah-tabs">


    <button
        type="button"
        class="hibah-tab active"
        data-sumber="APBD"
    >

        APBD

    </button>



    <button
        type="button"
        class="hibah-tab"
        data-sumber="APBN"
    >

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
                <th>KONDISI</th>
                <th>NILAI HIBAH</th>
                <th>AKSI</th>

            </tr>

        </thead>



        <tbody id="hibahTableBody">


            <tr>

                <td
                    colspan="10"
                    style="text-align:center"
                >

                    Memuat data...

                </td>

            </tr>


        </tbody>


    </table>


</div>


</div>





<div
    id="rekapTahunOverlay"
    class="rekap-tahun-overlay"
    aria-hidden="true"
>


    <div class="rekap-tahun-card">


        <div class="rekap-tahun-header">


            <div>

                <h3>
                    Rekap Data per Tahun
                </h3>


                <p id="rekapTahunSubtitle">
                    Data Hibah APBD
                </p>


            </div>



            <button
                type="button"
                id="rekapTahunClose"
                class="rekap-tahun-close"
            >
                &times;
            </button>
        </div>
        <div
            id="rekapTahunContent"
            class="rekap-tahun-content"
        >

            <div class="rekap-tahun-empty">
                Memuat data...
            </div>
        </div>
    </div>
</div>




<!-- =========================
    DETAIL POPUP
========================= -->

<div
    id="detailOverlay"
    class="detail-overlay"
>


    <div class="detail-modal">


        <button
            type="button"
            id="detailClose"
            class="detail-close"
        >
            &times;
        </button>



        <h3>
            Detail Hibah
        </h3>



        <div id="detailContent" class="detail-body">


            Memuat data...

        </div>


    </div>


</div>

<script>

document.addEventListener('DOMContentLoaded', function(){


    const tahunButton =
    document.getElementById('tahunButton');


    const tahunMenu =
    document.getElementById('tahunMenu');



    if(!tahunButton || !tahunMenu){
        return;
    }



    tahunButton.addEventListener('click', function(e){


        e.preventDefault();


        e.stopPropagation();


        tahunMenu.classList.toggle('show');


        tahunButton.classList.toggle('open');


    });




    document.querySelectorAll('.tahun-menu button')
    .forEach(button=>{


        button.addEventListener('click', function(e){


            e.preventDefault();


            e.stopPropagation();



            urutanTahun = this.dataset.value;



            tahunButton.querySelector('.tahun-label').innerText =
            this.innerText;



            tahunMenu.classList.remove('show');


            tahunButton.classList.remove('open');



           if(
    typeof currentHibahData !== 'undefined' &&
    Array.isArray(currentHibahData)
){

    currentHibahData.sort((a,b)=>{

        let tahunA = Number(a.tahun) || 0;
        let tahunB = Number(b.tahun) || 0;


        if(urutanTahun === 'desc'){

            return tahunB - tahunA;

        }


        return tahunA - tahunB;

    });


    const event =
    new Event('tahunChanged');


    document.dispatchEvent(event);

}


        });


    });





    document.addEventListener('click', function(e){


        if(
            !tahunButton.contains(e.target) &&
            !tahunMenu.contains(e.target)
        ){


            tahunMenu.classList.remove('show');


            tahunButton.classList.remove('open');


        }


    });



});


function lihatDetail(id,sumber)
{

    let url =
    `/hibah/${sumber.toLowerCase()}/data`;


    fetch(url)

    .then(res=>res.json())

    .then(result=>{


        let data =
        result.find(
            item=>item.id == id
        );



        if(!data){
            return;
        }



        let html = `


        ${
            data.foto

            ?

            `
            <img 
            src="/storage/${data.foto}"
            style="
            width:250px;
            height:250px;
            object-fit:contain;
            border-radius:15px;
            margin-bottom:20px;
            ">
            `

            :

            `
            <p>
            Foto tidak tersedia
            </p>
            `
        }



        <table>


        <tr>
        <th>Kegiatan</th>
        <td>${data.kegiatan}</td>
        </tr>


        <tr>
        <th>Unit</th>
        <td>${data.unit}</td>
        </tr>


        <tr>
        <th>Kelompok</th>
        <td>${data.nama_kelompok}</td>
        </tr>


        <tr>
        <th>Kondisi</th>
        <td>${data.kondisi}</td>
        </tr>


        <tr>
        <th>Tahun</th>
        <td>${data.tahun}</td>
        </tr>


        <tr>
        <th>Nilai Hibah</th>
        <td>
        Rp ${Number(data.nilai_hibah)
        .toLocaleString('id-ID')}
        </td>
        </tr>


        <tr>
        <th>Tanggal Input</th>
        <td>
           ${new Date(data.created_at)
            .toLocaleString('id-ID',{
                day:'2-digit',
                month:'2-digit',
                year:'numeric',
                hour:'2-digit',
                minute:'2-digit'
            })}
            </td>
        </tr>


        <tr>
        <th>Update Terakhir</th>
        <td>
            ${new Date(data.updated_at)
            .toLocaleString('id-ID',{
                day:'2-digit',
                month:'2-digit',
                year:'numeric',
                hour:'2-digit',
                minute:'2-digit'
            })}
            </td>
        </tr>


        </table>

        `;



        document.getElementById(
            'detailContent'
        ).innerHTML = html;



        document.getElementById(
            'detailOverlay'
        ).classList.add('show');


    });


}



document.getElementById('detailClose')
.addEventListener('click',function(){


    document.getElementById('detailOverlay')
    .classList.remove('show');


});
</script>


@endsection