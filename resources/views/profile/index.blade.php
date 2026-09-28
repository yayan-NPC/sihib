@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Profil Saya</h1>
        <p>Informasi akun pengguna SIHIB</p>
    </div>
</div>


<div class="profile-container">

    {{-- COVER --}}
    <div class="profile-cover"></div>


    {{-- PROFILE HEADER --}}
    <div class="profile-header">

        <div class="profile-photo">

    <div class="avatar-placeholder">


        @if(auth()->user()->photo)

            <img 
                src="{{ asset('storage/profile/'.auth()->user()->photo) }}"
                class="profile-image"
            >

        @else

            <svg 
                width="45"
                height="45"
                viewBox="0 0 24 24">

                <path 
                    d="M4 20c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

        @endif


    </div>

</div>

        {{-- IDENTITAS --}}
        <div class="profile-name">

            <h2>
                {{ auth()->user()->name ?? 'Admin SIHIB' }}

                <span class="badge">
                    ADMIN
                </span>
            </h2>


            <p>
                Administrator Sistem SIHIB
            </p>
             
        </div>

    </div>



    {{-- DETAIL PROFILE --}}

<div class="profile-detail">

    <h3>
        Informasi Profil
    </h3>


    <div class="profile-grid">

        <div class="profile-item">
            <label>
                Nama Lengkap
            </label>

            <strong>
                {{ auth()->user()->name ?? 'Admin SIHIB' }}
            </strong>
        </div>


        <div class="profile-item">
            <label>
                Email
            </label>

            <strong>
                {{ auth()->user()->email ?? '-' }}
            </strong>
        </div>


        <div class="profile-item">
            <label>
                Hak Akses
            </label>

            <strong>
                Administrator
            </strong>
        </div>


        <div class="profile-item">
            <label>
                Status
            </label>

            <strong class="status-active">
                ● Aktif
            </strong>
        </div>

    </div>

</div>

@endsection