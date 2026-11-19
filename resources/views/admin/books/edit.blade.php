@extends('layouts.app')

@section('content')
<div class="card w-75 d-block mx-auto mt-3">
    <div class="card-header">
        <h1>Edit Buku</h1>
    </div>
     @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mt-2">
                <div class="col-6">
                    <label for="book_category_id" class="form-label">Kategori Buku</label>
                    <select class="form-select" id="book_category_id"
                        name="book_category_id">
                        <option value="">Pilih Kategori</option>
                        @foreach ($bookCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('book_category_id', $book->book_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="title"
                        name="title" value="{{ old('title', $book->title) }}">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-6">
                    <label for="writer" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="writer"
                        name="writer" value="{{ old('writer', $book->writer) }}">
                </div>
                <div class="col-6">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="publisher"
                        name="publisher" value="{{ old('publisher', $book->publisher) }}">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-6">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price"
                        name="price" value="{{ old('price', $book->price) }}">
                </div>
             <div class="col-6">
                <label for="language" class="form-label">Bahasa</label>
                @php
                $language = ['Indonesia', 'English', 'Japan', 'Arabic'];
                @endphp

                <select class="form-select" name="language" id="language" required>
                    <option value="" disabled>Pilih Bahasa</option>

                    @foreach ($language as $lang)
                    <option value="{{$lang}}" {{ old('language', $book->language) == $lang ? 'selected' : ''}}>{{ $lang }}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="row mt-2">
                <div class="mb-3 col-6">
                    <label for="release_date" class="form-label">Tanggal Rilis</label>
                    <input type="date" class="form-control"
                        id="release_date" name="release_date" value="{{ old('release_date', $book->release_date) }}">
                </div>
                <div class="col-6">
                    <label for="page_of_book" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control"
                        id="page_of_book" name="page_of_book" value="{{ old('page_of_book', $book->page_of_book) }}">
                </div>
            </div>

            <div class="row mt-2">
                <label for="cover" class="form-label">Sampul Buku</label>

                {{-- Tampilkan Preview Sampul Lama --}}
                @if ($book->cover)
                <div class="col-12">
                    <img src="{{ asset($book->cover) }}" alt="Cover {{ $book->title }}"
                        class="img-thumbnail" style="max-height: 150px;">
                </div>
                @endif

                <input type="file" class="form-control" id="cover"
                    name="cover">
            </div>

            <div class="row mt-2">
                 <div class="col-12">
                <label for="description" class="form-label">Deskripsi Buku</label>
                <div id="description"></div>

                {{-- Menampung nilai awal dari database atau inputan sebelumnya --}}
                <input type="hidden" name="description" id="description-input"
                    value="{{ old('description', $book->description) }}">
                 </div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 15%">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Library DOMPurify untuk sanitasi XSS aman -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.8/purify.min.js"></script>
<script>
    const quill = new Quill('#description', {
        theme: 'snow',
    });

    const descriptionInput = document.getElementById('description-input');

    // render nilai lama dari db secara aman menggunakan DOMPurify 
    if (descriptionInput.value) {
        quill.clipboard.dangerouslyPasteHTML(descriptionInput.value);
    }

    // Jika deskripsi berubah, simpan ke input hidden description untuk di  kirim ke controller
    quill.on('text-change', function() {
        descriptionInput.value = quill.root.innerHTML;
    });
</script>
@endpush