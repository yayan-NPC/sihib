<aside class="sidebar">


    <!-- LOGO + TITLE -->

<div class="sidebar-top">


    <div class="logo-circle">

        <img src="{{ asset('images/S.png') }}" alt="SIHIB">

    </div>



    <div class="brand-title">

        <h2>
            SIMANTAP
        </h2>


         <p>
        Sistem Informasi Monitoring<br>
        dan Pemanfaatan Sarana<br>
        Prasarana Peternakan<br>
        Hibah Barang
        </p>

    </div>


</div>



    <!-- MENU -->

    <nav class="sidebar-menu">


        <!-- DASHBOARD -->

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">


            <span class="icon">

                <svg viewBox="0 0 24 24">

                    <circle cx="12" cy="12" r="9"/>

                    <circle cx="12" cy="12" r="3"/>

                </svg>

            </span>


            Dashboard


        </a>





        <!-- DATA HIBAH -->

        <a href="{{ route('hibah.index') }}"
           class="sidebar-link {{ request()->is('hibah*') ? 'active' : '' }}">


            <span class="icon">

                <svg viewBox="0 0 24 24">

                    <rect x="4" y="5" width="16" height="14" rx="2"/>

                    <line x1="8" y1="9" x2="16" y2="9"/>

                    <line x1="8" y1="13" x2="16" y2="13"/>

                </svg>

            </span>


            Data Hibah


        </a>


        <!-- LAPORAN -->

       <button class="sidebar-link dropdown-toggle"
        onclick="toggleDropdown('laporan', this)">


            <span class="icon">

                <svg viewBox="0 0 24 24">

                    <path d="M4 6h16"/>

                    <path d="M4 12h16"/>

                    <path d="M4 18h16"/>

                </svg>

            </span>


            Laporan


            <span class="arrow">

            <x-heroicon-o-chevron-down />

            </span>


        </button>




        <div class="submenu" id="laporan">


            <a href="{{ route('laporan.tahunan') }}">
            Laporan Tahunan
            </a>


            <a href="{{ route('laporan.excel', 'APBD') }}">
                Export Excel
            </a>


            <a href="{{ route('laporan.word', 'APBD') }}">
                Export Word
            </a>


        </div>






       <!-- PROFILE -->

     <a href="{{route('profile')}}"
        class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">

            <span class="icon">

                <svg viewBox="0 0 24 24">

                    <circle cx="12" cy="8" r="4"/>

                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>

                </svg>

            </span>


            Pengguna


        </a>






        <!-- SETTING -->

        <a href="{{ route('settings') }}" class="sidebar-link">

    <span class="icon">

        <svg viewBox="0 0 24 24">

            <circle cx="12" cy="12" r="3"/>

            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>

        </svg>

    </span>


    <span>
        Pengaturan
    </span>

</a>

<form
    method="POST"
    action="{{ route('logout') }}"
    class="confirm-form"

    data-confirm-type="logout"

    data-confirm-title="Logout"

    data-confirm-message="Apakah Anda yakin ingin keluar dari sistem?"

    data-confirm-text="Ya, Logout"
>

    @csrf


    <button
        type="submit"
        class="logout-link"
    >

        <x-heroicon-o-arrow-right-on-rectangle />

        <span>
            Logout
        </span>
    </button>

</form>

    </nav>





    <!-- FOOTER -->


   <div class="sidebar-footer">

    <div>
        <small>
           versi 1.1.0
        </small>

        

    </div>

</div>

</aside>