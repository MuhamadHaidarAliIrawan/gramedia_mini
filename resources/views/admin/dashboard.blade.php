@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>
    </div>
@endsection
<div class="navbar-nav mx-auto w-50">
    @if (Auth::check() && Auth::user()->role == 'admin')
        <!-- <li class="nav-item active">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Kategori Buku</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Paket Langganan</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Buku</a>
        </li> -->
    @else
        {{-- Kategori --}}
        <div class="dropdown mt-2">...
        </div>
        {{-- Search --}}
        <div class="input-icon w-100 py-2">...
        </div>
        {{-- Keranjang --}}
        <div class="mt-3 ms-2">
            <i class="fa-solid fa-cart-arrow-down fs-3 text-dark"></i>
        </div>
    @endif
</div>