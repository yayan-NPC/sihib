@extends('layouts.app')

@section('content')

<div class="dashboard-wrapper">

    {{-- ================= HEADER ================= --}}
    <div class="page-header">
        <div>
            <h1>
                Dashboard
            </h1>

            <p>
                Sistem Informasi Hibah Barang
            </p>
        </div>
    </div>



    {{-- ================= STAT CARD ================= --}}
    <div class="dashboard-grid">

        <div class="stat-card">
            <div class="stat-card-header">
                <span>
                    Total Hibah
                </span>

                <div class="stat-icon">
                    <x-heroicon-o-banknotes />
                </div>
            </div>

            <h2>
                Rp {{ number_format($total,0,',','.') }}
            </h2>

            <p>
                Akumulasi seluruh dana hibah
            </p>
        </div>



        <div class="stat-card">
            <div class="stat-card-header">
                <span>
                    Hibah APBD
                </span>

                <div class="stat-icon">
                    <x-heroicon-o-building-library />
                </div>
            </div>

            <h2>
                Rp {{ number_format($totalAPBD,0,',','.') }}
            </h2>

            <p>
                Dana pemerintah daerah
            </p>
        </div>



        <div class="stat-card">
            <div class="stat-card-header">
                <span>
                    Hibah APBN
                </span>

                <div class="stat-icon">
                    <x-heroicon-o-building-office-2 />
                </div>
            </div>

            <h2>
                Rp {{ number_format($totalAPBN,0,',','.') }}
            </h2>

            <p>
                Dana pemerintah pusat
            </p>
        </div>



        <div class="stat-card">
            <div class="stat-card-header">
                <span>
                    Penerima Hibah
                </span>

                <div class="stat-icon">
                    <x-heroicon-o-user-group />
                </div>
            </div>

            <h2>
                {{ $jumlahPenerima }}
            </h2>

            <p>
                Kelompok penerima hibah
            </p>
        </div>

    </div>



    {{-- ================= CHART ================= --}}
    <div class="dashboard-chart-grid">

        <div class="dashboard-card-chart">
            <h3>
                Realisasi Hibah Per Tahun
            </h3>

            <div class="chart-box">
                <canvas id="hibahChart"></canvas>
            </div>
        </div>



        <div class="dashboard-card-chart">
            <h3>
                Komposisi Dana
            </h3>

            <div class="chart-box-small">
                <canvas id="danaChart"></canvas>
            </div>
        </div>

    </div>



    {{-- ================= TABLE ================= --}}
    <div class="dashboard-card-table">

        <div class="table-title">
            <h3>
                Hibah Terbaru
            </h3>
        </div>

        <div class="table-responsive">
            <table class="dashboard-table">

                <thead>
                    <tr>
                        <th>
                            Kegiatan
                        </th>

                        <th>
                            Kelompok
                        </th>

                        <th>
                            Tahun
                        </th>

                        <th>
                            Nilai Hibah
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($hibahTerbaru as $h)
                        <tr>
                            <td>
                                {{ $h->kegiatan }}
                            </td>

                            <td>
                                {{ $h->nama_kelompok }}
                            </td>

                            <td>
                                {{ $h->tahun }}
                            </td>

                            <td>
                                Rp {{ number_format($h->nilai_hibah,0,',','.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(
    document.getElementById('hibahChart'),
    {
        type: 'bar',
        data: {
            labels: @json($grafikTahun->keys()),
            datasets: [{
                label: 'Nilai Hibah',
                data: @json($grafikTahun->values()),
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    }
);

new Chart(
    document.getElementById('danaChart'),
    {
        type: 'doughnut',
        data: {
            labels: [
                'APBD',
                'APBN'
            ],
            datasets: [{
                data: [
                    {{ $totalAPBD }},
                    {{ $totalAPBN }}
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    }
);
</script>

@endsection