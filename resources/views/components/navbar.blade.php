<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <span class="navbar-toggler-icon"></span>
        <!-- BEGIN NAVBAR LOGO -->
        <a href="." aria-label="Tabler" class="navbar-brand navbar-brand-autodark me-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68" class="navbar-brand-image">
            </svg>
        </a>
        <!-- END NAVBAR LOGO -->
        <div class="navbar-nav mx-auto w-50">
            @if (Auth:: check() && Auth:: user()->role == 'admin')
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.book-categories.index') }}" class="nav-link {{ request()->routeIs('admin.book-categories.index') ? 'active' : ''}}">Kategori Buku</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subscription-plans.index') }}" class="nav-link {{ request()->routeIs('admin.subscription-plans.index') ? 'active' : ''}}">Paket Langganan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : ''}}">Buku</a>
                </li>
            @else
            <div class="dropdown mt-2 me-3">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</button>
                <div class="dropdown-menu dropdown-menu-card" style="min-width: 600px">
                    <div class="p-3">
                        <div class="row g-2">
                            <div class="col-3">
                                <div class="card py-2">
                                    <div class="card-body p-2 text-center">Kategori 1</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card py-2">
                                    <div class="card-body p-2 text-center">Kategori 2</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card py-2">
                                    <div class="card-body p-2 text-center">Kategori 3</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card py-2">
                                    <div class="card-body p-2 text-center">Kategori 4</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card py-2">
                                    <div class="card-body p-2 text-center">Kategori 5</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--- SEARCH ---}}
            <div class="input-icon w-100 py-2">
                <input type="text" value class="form-control form-control-rounded" placeholder="Cari judul, produk, buku, penulis..." />
                <span class="input-icon-addon ">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/search -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon">
                        <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                </span>
            </div>
            {{--- Keranjang ---}}
            <div class="mt-3 ms-2">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            @endif
        </div>
        <div class="flex-row order-md-last ms-auto"></div>
        @if(Auth::check())
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
        <a href="{{ route('register') }}" class="btn btn-light">Daftar</a>
        @endif
    </div>
</header>