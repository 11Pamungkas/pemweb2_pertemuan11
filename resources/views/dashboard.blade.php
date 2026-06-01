@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Dashboard Perpustakaan</h2>

    <div class="row">

        {{-- Statistik Buku --}}
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5>Total Buku</h5>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Buku Tersedia</h5>
                    <h2>{{ $bukuTersedia }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5>Buku Habis</h5>
                    <h2>{{ $bukuHabis }}</h2>
                </div>
            </div>
        </div>

        {{-- Statistik Anggota --}}
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h2>{{ $totalAnggota }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Anggota Aktif</h5>
                    <h2>{{ $anggotaAktif }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-secondary text-white mb-3">
                <div class="card-body">
                    <h5>Anggota Nonaktif</h5>
                    <h2>{{ $anggotaNonaktif }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Buku terbaru --}}
    <div class="card mt-4">
        <div class="card-header">
            5 Buku Terbaru
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($bukuTerbaru as $buku)
                    <li class="list-group-item">
                        {{ $buku->judul }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Anggota terbaru --}}
    <div class="card mt-4">
        <div class="card-header">
            5 Anggota Terbaru
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($anggotaTerbaru as $anggota)
                    <li class="list-group-item">
                        {{ $anggota->nama }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="mt-4">
        <a href="{{ route('buku.index') }}" class="btn btn-primary">
            Kelola Buku
        </a>

        <a href="{{ route('anggota.index') }}" class="btn btn-success">
            Kelola Anggota
        </a>
    </div>

</div>
@endsection