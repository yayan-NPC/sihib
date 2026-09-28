<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        SIHIB
    </title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

{{-- GLOBAL CONFIRMATION MODAL --}}
<div class="confirm-overlay" id="confirmOverlay">

    <div class="confirm-modal">

        <div class="confirm-modal-icon" id="confirmIcon">
            <svg viewBox="0 0 24 24">
                <path d="M12 9v4"/>
                <path d="M12 17h.01"/>
                <path d="M10.3 3.5 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.5a2 2 0 0 0-3.4 0Z"/>
            </svg>
        </div>

        <div class="confirm-modal-content">

            <h3 id="confirmTitle">
                Konfirmasi
            </h3>

            <p id="confirmMessage">
                Apakah Anda yakin?
            </p>

        </div>

        <div class="confirm-modal-actions">

            <button
                type="button"
                class="confirm-btn-cancel"
                id="confirmCancel"
            >
                Batal
            </button>

            <button
                type="button"
                class="confirm-btn-submit"
                id="confirmSubmit"
            >
                Ya, Lanjutkan
            </button>

        </div>

    </div>

</div>

<body>


<div class="wrapper">


    {{-- SIDEBAR --}}
    @include('layouts.sidebar')



    <main class="content">



        {{-- TOPBAR --}}
        @if(
            request()->routeIs('dashboard') ||
            request()->routeIs('hibah.index')
        )


        <div class="app-topbar">



            {{-- SEARCH --}}
            <div class="app-search">


                <svg viewBox="0 0 24 24">


                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    />


                    <line
                        x1="16"
                        y1="16"
                        x2="21"
                        y2="21"
                    />


                </svg>



                <input
                type="text"
                id="globalSearch"
                placeholder="Search anything..."
                autocomplete="off"
            >


            </div>





            {{-- ACTION --}}
            <div class="app-actions">



                {{-- THEME --}}

                <button
                    class="top-icon"
                    id="themeToggle"
                >


                    <x-heroicon-o-moon class="moon-icon"/>


                    <x-heroicon-o-sun class="sun-icon"/>


                </button>


                {{-- USER --}}

                <div class="user-mini">


                    <div class="user-avatar">


@if(auth()->user()->photo)


<img 
src="{{ asset('storage/profile/'.auth()->user()->photo) }}"
class="top-profile-image"
>


@else


{{ strtoupper(
substr(
auth()->user()->name ?? 'A',
0,
1
)
) }}


@endif


</div>


                </div>


            </div>


        </div>


        @endif






        {{-- GLOBAL ALERT / TOAST --}}

        @include('components.alert')





        {{-- CONTENT PAGE --}}

               @yield('content')

    </main>

</div>


{{-- GLOBAL CONFIRM MODAL --}}
@include('components.confirm-modal')


</body>
</html>