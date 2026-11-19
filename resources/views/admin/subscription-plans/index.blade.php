@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Paket Langganan</h1>
            <div class="d-flex gap-2">
            <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-primary mb-3">Tambah Paket Langganan</a>
            <a href="{{ route('admin.subscription-plans.export') }}" class="btn btn-success mb-3">Export Excel</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive bg-white w-100" id="subscription-plans-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Paket</th>
                            <th>Deskripsi</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Diisi otomatis oleh DataTables via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#subscription-plans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.subscription-plans.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name_package', name: 'name_package' },
                    { data: 'description', name: 'description' },
                    { data: 'color', name: 'color' },
                    { data: 'price', name: 'price' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush