@extends('layouts.app')

@section('content')


<div class="page-header">

    <div>

        <h1>
            Export Excel
        </h1>


        <p>
            Data hibah APBD dan APBN
        </p>

    </div>

</div>




<div class="export-page-card">


<div class="export-topbar">



    {{-- TAB APBD APBN --}}

    <div class="export-tabs">

    <a 
    href="?sumber=APBD&urutan={{ request('urutan','desc') }}&kegiatan={{ request('kegiatan','') }}"
    class="export-tab {{ request('sumber','APBD') == 'APBD' ? 'active' : '' }}">

        APBD

    </a>


    <a 
    href="?sumber=APBN&urutan={{ request('urutan','desc') }}&kegiatan={{ request('kegiatan','') }}"
    class="export-tab {{ request('sumber') == 'APBN' ? 'active' : '' }}">

        APBN

    </a>

</div>





    {{-- RIGHT ACTION --}}

    <div class="export-action">

        {{-- FILTER KEGIATAN --}}

<form method="GET">

    <input 
    type="hidden"
    name="sumber"
    value="{{ $sumber }}"
    >

    <input 
    type="hidden"
    name="urutan"
    value="{{ request('urutan','desc') }}"
    >


    <div class="kegiatan-filter">


<button
type="button"
class="kegiatan-button"
id="kegiatanButton">


<span class="tahun-label">

@if(request('kegiatan'))

    {{ request('kegiatan') }}

@else

    Semua Data

@endif

</span>


<span class="arrow">

<x-heroicon-o-chevron-down />

</span>


</button>



<div 
class="kegiatan-menu"
id="kegiatanMenu">


<a href="?sumber={{$sumber}}&urutan={{request('urutan','desc')}}">

Semua Data

</a>



@foreach($kegiatan as $item)

<a href="?sumber={{$sumber}}&urutan={{request('urutan','desc')}}&kegiatan={{$item}}">

    {{ \Illuminate\Support\Str::limit($item, 22, '...') }}

</a>

@endforeach

</div>


</div>


</form>

        {{-- FILTER TAHUN --}}

        <div class="tahun-filter">


            <button
                type="button"
                class="tahun-button"
                id="tahunButton">


                <span class="tahun-label">

                    {{ request('urutan') == 'asc' ? 'Terlama' : 'Terbaru' }}

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





        {{-- EXPORT BUTTON --}}


        @if($data->count() > 0)



       <a href="{{ route(
            'laporan.excel.download',
            [
                'sumber'=>$sumber,
                'urutan'=>request('urutan','desc'),
                'kegiatan'=>request('kegiatan')
            ]
        ) }}"

        class="export-btn confirm-export"


        data-title="Export Excel"


        data-message="Apakah Anda yakin ingin export data hibah {{ $sumber }} ke Excel?">


            Export Excel


        </a>



        @else



        <button class="export-btn disabled" disabled>

            Data Tidak Tersedia

        </button>   



        @endif



    </div>



</div>







<div class="export-title">


    DATA HIBAH BARANG DANA

    <span>
    {{ request('sumber','APBD') }}
    </span>

    @if(request('kegiatan'))

    <span>
    - {{ request('kegiatan') }}
    </span>

    @endif


</div>


<div class="export-table-wrapper">


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


</tr>


</thead>





<tbody>



@forelse($data as $i=>$item)



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

{{ number_format($item->nilai_hibah) }}

</td>



</tr>




@empty



<tr>

<td colspan="9" style="text-align:center">

Data belum tersedia

</td>

</tr>



@endforelse



</tbody>



</table>


</div>





</div>





<script>


const slider =
document.querySelector('.export-table-wrapper');



let isDown = false;

let startX;

let scrollLeft;




if(slider){


slider.addEventListener('mousedown',(e)=>{


    isDown = true;


    slider.classList.add('active');


    startX =
    e.pageX - slider.offsetLeft;


    scrollLeft =
    slider.scrollLeft;


});





slider.addEventListener('mouseleave',()=>{


    isDown=false;


    slider.classList.remove('active');


});





slider.addEventListener('mouseup',()=>{


    isDown=false;


    slider.classList.remove('active');


});





slider.addEventListener('mousemove',(e)=>{


    if(!isDown) return;


    e.preventDefault();



    const x =
    e.pageX - slider.offsetLeft;



    const walk =
    (x-startX)*1.5;



    slider.scrollLeft =
    scrollLeft-walk;



});


}




const tahunButton =
document.getElementById('tahunButton');

const tahunMenu =
document.getElementById('tahunMenu');


if(tahunButton && tahunMenu){


    tahunButton.addEventListener('click', function(e){

        e.stopPropagation();

        tahunMenu.classList.toggle('show');

        tahunButton.classList.toggle('open');

    });



    document.querySelectorAll('.tahun-menu button')
    .forEach(button=>{


        button.addEventListener('click', function(){


            let params =
            new URLSearchParams(
                window.location.search
            );


            params.set(
                'urutan',
                this.dataset.value
            );

            

            params.set(
                'sumber',
                params.get('sumber') ?? 'APBD'
            );

           

            window.location.href =
                window.location.pathname +
                '?' +
                params.toString();


        });


    });



    document.addEventListener('click',function(e){


        if(
            !tahunButton.contains(e.target) &&
            !tahunMenu.contains(e.target)
        ){

            tahunMenu.classList.remove('show');

            tahunButton.classList.remove('open');

        }


    });


}

const kegiatanButton =
document.getElementById('kegiatanButton');


const kegiatanMenu =
document.getElementById('kegiatanMenu');



if(kegiatanButton && kegiatanMenu){


kegiatanButton.addEventListener('click',function(e){

    e.stopPropagation();

    kegiatanMenu.classList.toggle('show');

    kegiatanButton.classList.toggle('open');

});



document.addEventListener('click',function(e){

    if(
        !kegiatanButton.contains(e.target)
        &&
        !kegiatanMenu.contains(e.target)
    ){

        kegiatanMenu.classList.remove('show');

        kegiatanButton.classList.remove('open');

    }

});


}
const kegiatanLabel =
document.querySelector('#kegiatanButton .tahun-label');


if(kegiatanLabel){

    if(kegiatanLabel.innerText.length > 20){

        kegiatanLabel.style.fontSize = "12px";

    }

    if(kegiatanLabel.innerText.length > 35){

        kegiatanLabel.style.fontSize = "10px";

    }

}

</script>



@endsection