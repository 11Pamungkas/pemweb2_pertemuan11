@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Tambah Buku
    </a>

</div>

{{-- Statistik --}}
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted">
                            Total Buku
                        </h6>

                        <h2>
                            {{ $totalBuku }}
                        </h2>
                    </div>

                    <i class="bi bi-book-fill text-primary"
                        style="font-size: 3rem;">
                    </i>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted">
                            Buku Tersedia
                        </h6>

                        <h2>
                            {{ $bukuTersedia }}
                        </h2>
                    </div>

                    <i class="bi bi-check-circle-fill text-success"
                        style="font-size: 3rem;">
                    </i>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted">
                            Buku Habis
                        </h6>

                        <h2>
                            {{ $bukuHabis }}
                        </h2>
                    </div>

                    <i class="bi bi-x-circle-fill text-danger"
                        style="font-size: 3rem;">
                    </i>

                </div>

            </div>
        </div>
    </div>

</div>

{{-- Search & Filter --}}
<div class="card mb-4 shadow-sm">

    <div class="card-body">

        <form action="{{ route('buku.search') }}" method="GET">

            <div class="row g-3">

                {{-- Keyword --}}
                <div class="col-md-3">

                    <input type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari judul/pengarang/penerbit..."
                        value="{{ request('keyword') }}">

                </div>

                {{-- Kategori --}}
                <div class="col-md-2">

                    <select name="kategori" class="form-select">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($kategoris as $item)

                            <option value="{{ $item }}"
                                {{ request('kategori') == $item ? 'selected' : '' }}>

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tahun --}}
                <div class="col-md-2">

                    <select name="tahun" class="form-select">

                        <option value="">
                            Semua Tahun
                        </option>

                        @foreach($tahuns as $tahun)

                            <option value="{{ $tahun }}"
                                {{ request('tahun') == $tahun ? 'selected' : '' }}>

                                {{ $tahun }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Ketersediaan --}}
                <div class="col-md-2">

                    <select name="ketersediaan" class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="tersedia"
                            {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>

                        <option value="habis"
                            {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>
                            Habis
                        </option>

                    </select>

                </div>

                {{-- Button --}}
                <div class="col-md-3 d-flex gap-2">

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>

                    <a href="{{ route('buku.index') }}"
                        class="btn btn-secondary w-100">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- List Buku --}}
<div class="row">

    @forelse($bukus as $buku)

        <div class="col-md-4">

            <x-buku-card :buku="$buku" />

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">

                <i class="bi bi-info-circle"></i>

                Tidak ada data buku ditemukan.

            </div>

        </div>

    @endforelse

</div>

{{-- Footer Info --}}
@if($bukus->count() > 0)

    <div class="text-center mt-4">

        <p class="text-muted">

            Menampilkan {{ $bukus->count() }} buku

        </p>

    </div>

@endif

@endsection