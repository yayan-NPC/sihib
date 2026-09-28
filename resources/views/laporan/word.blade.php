@extends('layouts.app')


@section('content')


<div class="page-header">

    <div>

        <h1>
            Export Word
        </h1>


        <p>
            Data hibah APBD dan APBN
        </p>

    </div>

</div>





@if(session('error'))

<div class="alert-error">

    {{ session('error') }}

</div>

@endif






<div class="word-page-card">





<div class="word-topbar">



    {{-- TAB SUMBER --}}

    <div class="word-tabs">


        <a href="{{ route('laporan.word',[
            'sumber'=>'APBD',
            'urutan'=>request('urutan','desc')
        ]) }}"
        class="word-tab {{ $sumber=='APBD'?'active':'' }}">

            APBD

        </a>



        <a href="{{ route('laporan.word',[
            'sumber'=>'APBN',
            'urutan'=>request('urutan','desc')
        ]) }}"
        class="word-tab {{ $sumber=='APBN'?'active':'' }}">

            APBN

        </a>


    </div>






    <div class="word-action-area">

{{-- FILTER KEGIATAN --}}

<div class="kegiatan-filter">


<button
type="button"
class="kegiatan-button"
id="wordKegiatanButton">


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
id="wordKegiatanMenu">


<a href="{{ route('laporan.word',[
    'sumber'=>$sumber,
    'urutan'=>request('urutan','desc')
]) }}">

Semua Data

</a>



@foreach($kegiatan as $item)

<a href="{{ route('laporan.word',[
    'sumber'=>$sumber,
    'urutan'=>request('urutan','desc'),
    'kegiatan'=>$item
]) }}">

{{ \Illuminate\Support\Str::limit($item,22,'...') }}

</a>

@endforeach


</div>


</div>

        {{-- FILTER TAHUN --}}

        <div class="tahun-filter">


            <button
            type="button"
            class="tahun-button"
            id="wordTahunButton">


                <span class="tahun-label">

                    {{ request('urutan')=='asc'
                        ? 'Terlama'
                        : 'Terbaru'
                    }}

                </span>



                <span class="arrow">

                    <x-heroicon-o-chevron-down />

                </span>


            </button>





            <div
            class="tahun-menu"
            id="wordTahunMenu">


                <button data-value="desc">

                    Terbaru

                </button>



                <button data-value="asc">

                    Terlama

                </button>



            </div>


        </div>







        {{-- EXPORT BUTTON --}}


        @if($data->count())


        <a href="{{ route(
            'laporan.word.download',
            [
                'sumber'=>$sumber,
                'urutan'=>request('urutan','desc'),
                'kegiatan'=>request('kegiatan')
            ]
        ) }}"
        class="word-btn confirm-export"

        data-title="Export Word"

        data-message="Apakah Anda yakin ingin export data hibah {{ $sumber }} ke Word?">


            Export Word


        </a>


        @else


        <button class="word-btn disabled" disabled>

            Data Tidak Tersedia

        </button>


        @endif




    </div>




</div>










<div class="word-title">


    DATA HIBAH BARANG DANA


    <span>

        {{ $sumber }}

    </span>


</div>








<div class="word-table-wrapper">


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


// =============================
// DRAG TABLE WORD
// =============================


const wordTable =
document.querySelector('.word-table-wrapper');


if(wordTable){


let isDownWord = false;

let startXWord;

let scrollLeftWord;



wordTable.addEventListener(
'mousedown',
function(e){


isDownWord=true;


wordTable.classList.add('active');


startXWord =
e.pageX - wordTable.offsetLeft;


scrollLeftWord =
wordTable.scrollLeft;


});




wordTable.addEventListener(
'mouseleave',
function(){


isDownWord=false;


wordTable.classList.remove('active');


});




wordTable.addEventListener(
'mouseup',
function(){


isDownWord=false;


wordTable.classList.remove('active');


});




wordTable.addEventListener(
'mousemove',
function(e){


if(!isDownWord) return;


e.preventDefault();



const x =
e.pageX - wordTable.offsetLeft;



wordTable.scrollLeft =
scrollLeftWord -
((x-startXWord)*1.5);



});


}









// =============================
// DROPDOWN WORD
// =============================


const wordTahunButton =
document.getElementById(
'wordTahunButton'
);



const wordTahunMenu =
document.getElementById(
'wordTahunMenu'
);



if(
wordTahunButton &&
wordTahunMenu
){



wordTahunButton.addEventListener(
'click',
function(e){


e.stopPropagation();


wordTahunMenu.classList.toggle(
'show'
);


wordTahunButton.classList.toggle(
'open'
);



});







wordTahunMenu
.querySelectorAll('button')
.forEach(button=>{


button.addEventListener(
'click',
function(e){


e.stopPropagation();



let params =
new URLSearchParams(
window.location.search
);



params.set(
'urutan',
this.dataset.value
);



if(!params.get('sumber')){


params.set(
'sumber',
'{{ $sumber }}'
);


}



window.location.href =
window.location.pathname +
'?' +
params.toString();



});


});






document.addEventListener(
'click',
function(e){



if(
!wordTahunButton.contains(e.target)
&&
!wordTahunMenu.contains(e.target)
){


wordTahunMenu.classList.remove(
'show'
);


wordTahunButton.classList.remove(
'open'
);


}


});


}

const wordKegiatanButton =
document.getElementById('wordKegiatanButton');


const wordKegiatanMenu =
document.getElementById('wordKegiatanMenu');


if(wordKegiatanButton && wordKegiatanMenu){


wordKegiatanButton.addEventListener(
'click',
function(e){

    e.stopPropagation();

    wordKegiatanMenu.classList.toggle('show');

    wordKegiatanButton.classList.toggle('open');

});


document.addEventListener(
'click',
function(e){

    if(
        !wordKegiatanButton.contains(e.target)
        &&
        !wordKegiatanMenu.contains(e.target)
    ){

        wordKegiatanMenu.classList.remove('show');

        wordKegiatanButton.classList.remove('open');

    }

});


}

</script>




@endsection