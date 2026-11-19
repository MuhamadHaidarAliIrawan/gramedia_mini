@extends('layouts.app')

@push('styles')
    <style>
        .book-cover-wrap {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8fafc;
            border-radius: 6px;
        }

        .book-cover-img {
            max-height: 100%;
            width: auto;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 8px;
        }

        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08) !important;
        }

        .book-card:hover .book-cover-img {
            transform: scale(1.03);
        }

        .package-banner {
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        {{-- Tombol Kembali ke Beranda --}}
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>

        {{-- Detail Paket Langganan --}}
        <div class="card package-banner shadow-sm mb-4 border-0" style="background: {{ $subscriptionPackage->color }};">
            <div class="card-body p-4 text-dark">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-dark text-white px-2 py-1">
                                <i class="fa-solid fa-crown me-1 text-warning"></i> PAKET LANGGANAN
                            </span>
                            <span class="badge bg-white text-dark shadow-sm">
                                <i class="fa-solid fa-book-open me-1"></i>
                                {{ $totalPackageBooks ?? $subscriptionPackageBooks->count() }} Buku Tersedia
                            </span>
                        </div>
                        <h1 class="display-6 fw-bold mb-2">{{ strtoupper($subscriptionPackage->name_package) }}</h1>
                        <p class="mb-0 text-dark" style="max-width: 650px; font-size: 1rem; opacity: 0.9;">
                            {{ $subscriptionPackage->description }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('subscription-packages.payment', $subscriptionPackage->id) }}"
                            class="btn btn-primary btn-subscribe text-white ms-md-2">
                            Langganan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Header Daftar Buku & Search Bar --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <div class="row align-items-center g-3">
                    <div class="col-md-6">
                        <h3 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-books text-primary"></i> Daftar Buku Tertaut
                            @if($search)
                                <span class="badge bg-blue-lt fw-normal fs-5">Hasil: {{ $subscriptionPackageBooks->count() }}
                                    buku</span>
                            @endif
                        </h3>
                    </div>
                    <div class="col-md-6">
                        {{-- Form Pencarian Buku Berdasarkan Judul --}}
                        <form method="GET" action="{{ route('subscription.show', $subscriptionPackage->id) }}"
                            class="d-flex gap-2">
                            <div class="input-icon w-100">
                                <input type="text" name="search" value="{{ $search }}" class="form-control"
                                    placeholder="Cari judul buku pada paket ini..." />
                                <span class="input-icon-addon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                                Cari
                            </button>
                            @if($search)
                                <a href="{{ route('subscription.show', $subscriptionPackage->id) }}"
                                    class="btn btn-outline-secondary" title="Hapus Pencarian">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Buku Tertaut pada Paket Langganan --}}
        @if ($subscriptionPackageBooks->isEmpty())
            <div class="alert alert-info shadow-sm d-flex align-items-center py-4" role="alert">
                <i class="fa-solid fa-circle-info fa-2x me-3"></i>
                <div>
                    @if($search)
                        <h4 class="alert-title mb-1">Buku tidak ditemukan</h4>
                        <p class="mb-0">
                            Tidak ada buku dengan judul <b>"{{ $search }}"</b> pada paket langganan
                            <b>{{ $subscriptionPackage->name_package }}</b>.
                            <a href="{{ route('subscription.show', $subscriptionPackage->id) }}" class="alert-link ms-1">Reset
                                pencarian</a> untuk melihat semua buku.
                        </p>
                    @else
                        <h4 class="alert-title mb-1">Belum Ada Buku</h4>
                        <p class="mb-0">
                            Saat ini belum ada buku yang tertaut pada paket langganan
                            <b>{{ $subscriptionPackage->name_package }}</b>.
                        </p>
                    @endif
                </div>
            </div>
        @else
            <div class="row g-3">
                @foreach ($subscriptionPackageBooks as $item)
                    @php
                        $book = $item->book;
                    @endphp
                    @if ($book)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="card h-100 book-card shadow-sm border-0">
                                <div class="card-body p-3 d-flex flex-column">
                                    <div class="book-cover-wrap mb-2">
                                        @if($book->cover)
                                            <img src="{{ asset($book->cover) }}" alt="{{ $book->title }}" class="book-cover-img">
                                        @else
                                            <div class="text-muted text-center p-3">
                                                <i class="fa-solid fa-book fa-3x mb-2 text-secondary"></i>
                                                <div class="small">No Cover</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex gap-1 mb-2">
                                        <span class="badge bg-secondary-lt" style="font-size: 0.7rem;">
                                            <i class="fa-solid fa-mobile me-1"></i>PDF
                                        </span>
                                        @if($book->bookCategory)
                                            <span class="badge bg-blue-lt text-truncate" style="font-size: 0.7rem; max-width: 90px;"
                                                title="{{ $book->bookCategory->name }}">
                                                {{ $book->bookCategory->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1">
                                        <span class="text-secondary d-block text-truncate small" title="{{ $book->writer ?? '-' }}">
                                            {{ $book->writer ?? '-' }}
                                        </span>
                                        <h5 class="mb-1 text-truncate" style="font-size: 0.95rem; font-weight: 600;"
                                            title="{{ $book->title }}">
                                            {{ $book->title }}
                                        </h5>
                                    </div>

                                    <div class="mt-auto pt-2 border-top">
                                        <div class="small text-muted" style="font-size: 0.75rem;">Harga Buku:</div>
                                        <span class="text-primary fw-bold" style="font-size: 0.95rem;">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection