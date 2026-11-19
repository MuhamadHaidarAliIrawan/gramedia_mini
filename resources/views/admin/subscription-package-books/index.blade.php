@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.subscription-package-books.store', $subscriptionPackage->id) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between">
                <h1>Data Buku Yang Akan ditambahkan Ke Paket {{ $subscriptionPackage->name_package }}</h1>
                {{-- btn akan disembunyikan jika blm memilih buku (d-none) --}}
                {{-- (0) : akan diganti menjadi jumlah yg ceklis --}}
                <button type="submit" class="d-none btn btn-primary" id="btnBuku"><span id="jmlhBuku">(0)</span>Tambah
                    Buku</button>
            </div>

            <table class="table table-bordered" id="books-table">
                <thead>
                    <tr>
                        <th>Pilih Buku</th>
                        <th></th>
                        <th>Sampul Buku</th>
                        <th>Judul</th>
                        <th>Kategori Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const table = $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.subscription-package-books', ['packageId' => $subscriptionPackage->id]) }}",
                columns: [
                    {
                        //yg dikirim ke db ketika memilih ceklis buku adalah id nya 
                        data: null,//null : mengirim semua Attribute (semua yg ada di fillable & addColumn)
                        orderable: false,
                        searchable: false,
                        //mwengganti tampilan angka id jadi checkbox
                        render: function (data) {
                            //name menggunakan [] (array) karna bisa memilih lebih dari 1 buku
                            if (data.checkBook == true) {
                                return ``;
                            } else {
                                return `<input type= "checkbox" value="${data.id}" class="inputBookId" name="bookIds[]">`;
                            }
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'cover',
                        name: 'cover',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'writer',
                        name: 'writer'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                ]
            });

            //fungsi yg akan dipanggil tiap ada buku yg dipilih
            function updateSelectedBook() {
                //ambil jumlah class="inputBookId" yg di ceklis
                let selectedCount = $(".inputBookId:checked").length;
                //jumlahnya munculin ke html (0)
                $("#jmlhBuku").text(selectedCount);

                //munculkan tombol dengan menghilangkan d-none
                if (selectedCount > 0) {
                    $("#btnBuku").removeClass('d-none');
                } else {
                    //kalau yg dipilih 0, d-none di tambahkan biar btn ilang
                    $("#btnBuku").addClass('d-none');
                }

            }

            //panggil fungsi tiap kali checkbox di ceklis atau sebaliknya (un-ceklis)
            $("#books-table tbody").on("change", ".inputBookId", function () {
                updateSelectedBook();
            })
        });
    </script>
@endpush