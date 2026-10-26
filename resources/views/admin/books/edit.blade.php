@extends('layouts.app')

@section('content')
<div class="card w-75 d-block mx-auto mt-3">
    <div class="card-header">
        <h1>Tambah Buku</h1>
    </div>
    <!-- memunculkan semua error secara sekaligus : pengganti eror yg harus di tulis satu2 di semua inputan -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="card-body">
        @csrf
        <div class="row mt-2">
            <div class="col-6">
                <label for="book_category_id" class="form-label">Kategori Buku</label>
                <select class="form-select" name="book_category_id" id="book_category_id">
                    <option selected hidden disabled>Pilih Kategori Buku</option>
                    @foreach ($bookCategories as $category)
                    <option value="{{ $category->id }}" {{ old('book_category_id', $book->book_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $book->title) }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label for="writer" class="form-label">Penulis</label>
                <input type="text" class="form-control" name="writer" id="writer" value="{{ old('writer', $book->writer) }}">
            </div>
            <div class="col-6">
                <label for="publisher" class="form-label">Penerbit</label>
                <input type="text" class="form-control" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" name="price" id="price" value="{{ old('price', $book->price) }}">
            </div>
            <div class="col-6">
                <label for="title" class="form-label">Bahasa</label>
                <select class="form-select" name="language" id="language">
                    <option selected hidden disabled>Pilih Bahasa</option>
                    <option value="Indonesia">Bahasa Indonesia</option>
                    <option value="English">Bahasa Inggris</option>
                    <option value="Arabic">Bahasa Arab</option>
                    <option value="Chinese">Bahasa Mandarin</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label for="release_date" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control" name="release_date" id="release_date" value="{{ old('release_date', $book->release_date) }}">
            </div>
            <div class="col-6">
                <label for="page_of_book" class="form-label">Jumlah Halaman</label>
                <input type="number" class="form-control" name="page_of_book" id="page_of_book" value="{{ old('page_of_book', $book->page_of_book) }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="cover" class="form-label">Sampul Buku</label>
                <input type="file" class="form-control" name="cover" id="cover" value="{{ old('cover', $book->cover) }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="description" class="form-label">Deskripsi Buku</label>
                <div id="description">
                </div>
                 <input type="hidden" name="description" id="description-input" value="{{ old('description', $book->description) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 15%">Simpannn</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const quill = new Quill('#description', {
        theme: 'snow'
    });
    // jika deskripsi berubah isinya,simpen ke input hidden description untuk dikirm ke controller
    quill.on('text-change', function() {
        document.getElementById('description-input').value = quill.root.innerHTML;
    });
</script>
@endpush