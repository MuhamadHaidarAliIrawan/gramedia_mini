@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-4">
        <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <h2 class="mb-4" style="font-weight: bold">Kategori: {{ $bookCategory->name }}</h2>

    {{-- Search & Sort --}}
    <div class="row mb-4 g-3 align-items-end">
        <div class="col-md-8">
            <form method="GET" action="{{ route('category.books', $bookCategory->id) }}" id="filter-form">
                <div class="input-icon">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-rounded" placeholder="Cari judul buku atau penulis..." />
                    <input type="hidden" name="sort" value="{{ $sort }}" id="sort-hidden" />
                     <button type="submit" class="input-icon-addon btn border-0 p-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true"
                            focusable="false" class="icon">
                            <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </button>
                </div>
        </div>
        <div class="col-md-4">
            <label class="form-label text-secondary">Urutkan</label>
            <select class="form-select" id="sort-select" onchange="updateSort(this.value)">
                <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Buku Terbaru</option>
                <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
            </select>
            </form>
        </div>
    </div>

    {{-- Book List --}}
    @if($books->isEmpty())
        <div class="alert alert-info mt-3">
            Tidak ada buku ditemukan untuk kategori <b>{{ $bookCategory->name }}</b>.
        </div>
    @else
        <div class="row mt-3">
            @foreach($books as $book)
            <div class="px-2 col-md-2 col-sm-4 col-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <img src="{{ asset($book->cover) }}" class="d-block mx-auto w-75 h-50">
                        <div class="d-flex gap-2 mt-3">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem" class="text-secondary">{{ $book->writer }}</span>
                                <br><span style="font-size: 1rem">{{ $book->title }}</span>
                            </h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp
                                {{ number_format($book->price, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function updateSort(value) {
        document.getElementById('sort-hidden').value = value;
        document.getElementById('filter-form').submit();
    }
</script>
@endpush