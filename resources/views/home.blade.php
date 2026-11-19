@extends('layouts.app')
@push('styles')
<style>
    .slick-prev:before,
    .slick-next:before {
        color: #333;
    }

    .subscription-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    .subscription-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush
@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{--- BANNER ---}}
<div id="carousel-sample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" aria-label="Slide 1" aria-current="true" class="active"></button>
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" alt src="https://i.pinimg.com/1200x/87/1c/59/871c59a95205840c0b884d7a425b7481.jpg" />
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" alt src="https://i.pinimg.com/1200x/87/1c/59/871c59a95205840c0b884d7a425b7481.jpg" />
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" alt src="https://i.pinimg.com/1200x/87/1c/59/871c59a95205840c0b884d7a425b7481.jpg" />
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-sample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel-sample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

{{--- Paket Langganan ---}}
<div class="mt-4 p-5">
    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-yellow text-yellow-fg p-2">
            <i class="fa-solid fa-crown fs-3"></i>
            <h2 class="mt-3 text-dark">Paket Langganan</h2>
        </span>
    </div>
</div>
<div class="row g-4">
    @forelse($subscriptionPackages as $package)
    <div class="col-md-4">
        <a href="{{ route('subscription.show', $package->id) }}" class="text-decoration-none">
            <div class="card h-100 subscription-card" style="background: linear-gradient(135deg, #ffffff 0%, {{ $package->color }} 100%); cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body row align-items-center">
                    <div class="col-4 text-center">
                        <i class="fa-solid fa-crown fa-3x text-dark" style="opacity: 0.35;"></i>
                    </div>
                    <div class="col-8 text-center text-dark">
                        <h2 style="font-weight: bold">{{ strtoupper($package->name_package) }}</h2>
                        <p class="text-secondary" style="font-weight: bold; margin: 0 !important">PACKAGE</p>
                        <div>
                            Rp <span style="font-size: 2rem; font-weight: bold;" class="text-warning">{{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-secondary mt-2" style="font-size: 0.85rem;">{{ $package->description }}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center">Tidak ada paket langganan tersedia.</p>
    </div>
    @endforelse
</div>



{{--- Buku Terbaru ---}}
<div class="mt-4">
    <div class="d-flex align-items-center gap-2 mb-4">
        <h2 class="mt-3 text-dark" style="font-weight: bold">Buku Baru Dirilis</h2>
    </div>
</div>

<div id="wrapper-slider">
    @forelse($latestBook as $book)
    <div class="px-2">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset($book->cover) }}" class="img-fluid rounded" style="max-height: 100%; object-fit: contain;">
                </div>
                <div class="d-flex gap-2 mb-3">
                    <span class="badge"><i class="fa-solid fa-mobile"></i>PDF</span>
                    <span class="badge">3+</span>
                </div>
                <div class="mt-auto">
                    <h5 class="mb-1"><span style="font-size: 0.8rem" class="text-secondary">{{ $book->writer }}</span>
                        <br><a href="{{ route('books.show', $book->id) }}" style="font-size: 1rem">{{ $book->title }}</a>
                    </h5>
                    <h4 style="font-size: 1.2rem; font-weight: bold;" class="mb-0">Rp
                        {{ number_format($book->price, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center">Tidak ada buku terbaru.</p>
    @endforelse
</div>

{{--- Buku Gratis ---}}
<div class="mt-4">
    <div class="d-flex align-items-center gap-2 mb-4 mx-3">
        <h2 class="mt-3 text-dark" style="font-weight: bold;">Buku Gratis</h2>
    </div>
</div>

<div class="row">
    @forelse($freeBook as $book)
    <div class="col-4 mb-3">
        <div class="card d-flex flex-column h-100">
            <div class="row row-0 flex-fill">
                <div class="col-md-3">
                    {{-- Perbaikan: Mengarahkan link gambar ke detail buku yang benar --}}
                    <a href="{{ route('books.show', $book->id) }}">
                        <img src="{{ asset($book->cover) }}" class="w-100 h-100 object-cover" style="object-fit: cover;">
                    </a>
                </div>
                <div class="col">
                    <div class="card-body h-full d-flex flex-column">
                        <h3 class="card-title">
                            <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                        </h3>
                        <div class="text-secondary">
                            {{ $book->writer }}<br>
                            {{-- Perbaikan: Judul buku juga diberi link agar bisa diklik --}}
                            <a href="{{ route('books.show', $book->id) }}" class="text-dark text-decoration-none fw-bold">
                                {{ $book->title }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center pt-4 mt-auto">
                            <h3>
                                <span class="text-decoration-line-through text-secondary">Rp. 50.000</span>
                                <span class="text-dark">Rp. 0</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center">Tidak ada buku gratis.</p>
    </div>
    @endforelse

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#wrapper-slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 5,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    })
</script>
@endpush