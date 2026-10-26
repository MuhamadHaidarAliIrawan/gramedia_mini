@extends('layouts.app')
@push('styles')
<style>
    .slick-pref::before,
    .slick-next::before {
        color: black;
    }
</style>
@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success' )}}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error' )}}</div>
@endif
@if (Session::get('error'))
<div class="alert alert-important alert-danger alert-dismissible" role="alert">
    <div class="d-flex">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
        </div>
        <div>{{ Session::get('error') }}</div>
    </div>
    <a class="btn-close btn-close-white" data-bs-dismiss="alert"
        aria-label="close"></a>
</div>
@endif

<!-- BANNER -->
<div id="carousel-sample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" aria-label="Slide 1" aria-current="true" class="active"></button>
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active"><img class="d-block w-100" alt src="https://i.pinimg.com/1200x/58/52/30/58523074e9d6b922d83e5a76de912392.jpg" /></div>
        <div class="carousel-item"><img class="d-block w-100" alt src="https://i.pinimg.com/1200x/58/52/30/58523074e9d6b922d83e5a76de912392.jpg" /></div>
        <div class="carousel-item"><img class="d-block w-100" alt src="https://i.pinimg.com/1200x/58/52/30/58523074e9d6b922d83e5a76de912392.jpg" /></div>
    </div><button class="carousel-control-prev" type="button" data-bs-target="#carousel-sample" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button><button class="carousel-control-next" type="button" data-bs-target="#carousel-sample" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
</div>

<!-- PAKET LANGGANAN -->
<div class="p-5">
    <div class="d-flex align-items-center gap-3 py-4">
        <span class="badge bg-yellow text-yellow-fg p-2">
            <i class="fa-solid fa-crown fs-3"></i>
            <h2 class="mt-3 text-dark">Paket Langganan</h2>
        </span>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #6ef480 100%);">
                <div class="card-body row">
                    <div class="col-4"></div>
                    <div class="col-5 text-center text-dark">
                        <h2 style="font-weight: bold;">NON FICTION</h2>
                        <p class="text-secondary" style="font-weight: bold; margin: 0 !important">PACKAGE</p>
                        <div>
                            Rp <span style="font-size: 2rem; font-weight: bold;" class="text-warning">50.000</span>
                            <br>
                            <span class="text-secondary" style="font-weight: bold; margin: 0 !important">30 days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #67b7f0 100%);">
                <div class="card-body row">
                    <div class="col-4"></div>
                    <div class="col-5 text-center text-dark">
                        <h2 style="font-weight: bold;">FICTION</h2>
                        <p class="text-secondary" style="font-weight: bold; margin: 0 !important">PACKAGE</p>
                        <div>
                            Rp <span style="font-size: 2rem; font-weight: bold;" class="text-warning">50.000</span>
                            <br>
                            <span class="text-secondary" style="font-weight: bold; margin: 0 !important">30 days</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #f54ce7 100%);">
                <div class="card-body row">
                    <div class="col-4"></div>
                    <div class="col- text-center text-dark">
                        <h2 style="font-weight: bold;">PREMIUM</h2>
                        <p class="text-secondary" style="font-weight: bold; margin: 0 !important">PACKAGE</p>
                        <div>
                            Rp <span style="font-size: 2rem; font-weight: bold;" class="text-warning">50.000</span>
                            <br>
                            <span class="text-secondary" style="font-weight: bold; margin: 0 !important">30 days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buku Terbaru -->
<div class="mt-4">
    <div class="d-flex align-items-center gap-3 mb-2">
        <h2 class="text-dark" style="font-weight: bold;">Buku Baru rilis</h2>
    </div>
    <div id="wrapper-slider">
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2">
            <div class="card">
                <div class="card-body">
                    <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/picture_meta/2024/5/6/gpvujdd93vyxfj4ncmrxnd.jpeg" alt="Peternakan" class="d-block mx-auto w-75 h-50">
                    <div class="d-flex gap-2 mt-2">
                        <p class="badge"><i class="fa-solid fa-mobile"></i></p>
                        <p class="badge">3+</p>
                    </div>
                    <div>
                        <h5><span style="font-size: 0.8rem" class="text-secondary">Judul Buku</span>
                            <br><span style="font-size: 1rem">Card with title</span>
                        </h5>
                        <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 50.000</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--- Buku Gratis ---}}
<div class="mt-4">
    <div class="d-flex align-items-center gap-2 mb-4 mx-5">
        <h2 class="mt-3 text-dark" style="font-weight: bold;">Buku Gratis</h2>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 ">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2">
            <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="https://image.gramedia.net/rs:fit:0:0/f:webp/plain/https://cdn.gramedia.com/uploads/product-metas/semv-ptm-e.jpg" alt="">
                        </a>
                    </div>
                    <div class="col">
                        <div class="card-body h-full d-flex flex-column">
                            <h3 class="card-title">
                                <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                            </h3>
                            <div class="text-secondary">Penulis <br><span class="text-dark">Judul Buku</span></div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <h3>
                                    <span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                    <span class="text-dark">Rp 0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

                // Anda dapat menghapus fungsi slick pada breakpoint tertentu sekarang dengan menambahkan:
                // settings: "unslick"
                // sebagai pengganti dari objek settings
            ]
        });
    });
</script>
@endpush