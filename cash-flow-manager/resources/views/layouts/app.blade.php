<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> --}}
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::user())
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pemasukan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pengeluaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModalPemasukkan" style="width:100%;">
                                + Pemasukkan</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addModalPengeluaran" style="width:100%;">
                                + Pengeluaran</a>
                        </li>
                    </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <!--START: Modal Tambah Pemasukkan  -->
        <div class="modal fade" id="addModalPemasukkan" tabindex="-1" aria-labelledby="addModalPemasukkan" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pemasukkan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('transaction.store') }}" id="addPemasukkan">
                            @csrf
                            <div class="mb-1">
                                <label for="desc" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="mb-1">
                                <label for="desc" class="form-label">Nominal</label>
                                <input class="form-control" id="nominal" name="nominal" type="number" required>
                            </div>
                            <div class="mb-1">
                                <label for="desc" class="form-label">Category</label>
                                <select class="select form-select" tabindex="-1" aria-hidden="true" name="category_id" id="categories">
                                    <option selected disabled>-- Choose category --</option>
                                    @php( $category_pemasukkan = App\Models\Category::where('type', '=', 'M')->get())
                                    @foreach ( $category_pemasukkan as $category)
                                    <option value="{{ $category->id }}" data-select2-id="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="addPemasukkan" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Pemasukkan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Modal Tambah Pemasukan -->
        <!--START: Modal Tambah Pengeluaran  -->
        <div class="modal fade" id="addModalPengeluaran" tabindex="-1" aria-labelledby="addModalPengeluaran" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pengeluaran</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('transaction.store') }}" id="addPengeluaran">
                            @csrf
                            <div class="mb-1">
                                <label for="desc" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="mb-1">
                                <label for="desc" class="form-label">Nominal</label>
                                <input class="form-control" id="nominal" name="nominal" type="number" required>
                            </div>
                            <div class="mb-1">
                                <label for="desc" class="form-label">Desc</label>
                                <input class="form-control" id="desc" name="desc" type="text" required>
                            </div>
                            <div class="mb-1">
                                <label for="categories" class="form-label">Category</label>
                                <select class="select form-select" tabindex="-1" aria-hidden="true" name="category_id" id="categories">
                                    <option selected disabled>-- Choose category --</option>
                                    @php( $category_pengeluaran = App\Models\Category::where('type', '=', 'K')->get())
                                    @foreach ( $category_pengeluaran as $category)
                                    <option value="{{ $category->id }}" data-select2-id="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="addPengeluaran" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Pengeluaran</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Modal Tambah Pemasukan -->
    </div>
</body>

</html>
