@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            Hello, {{Auth::user()->name}}!<br>
            Jangan lupa cek keuangan anda!
            <h5> Saldo Anda : {{$saldo}}</h5>
        </div>
    </div>


    <div class="row justify-content-center mt-2">
        <div class="col-6">
            <div class="card table-responsive p-3">
                <h5>Pemasukan Tahun {{date("Y")}}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kategori</th>
                            <th scope="col">Month</th>
                            <th scope="col">Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiPemasukkanPerBulanPerCategory as $data)
                        <tr>
                            <th scope="row">{{$data->name}}</th>
                            <td>{{$data->bulan}}</td>
                            <td>{{$data->total}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="card table-responsive p-3">
                <h5>Pengeluaran Tahun {{date("Y")}}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kategori</th>
                            <th scope="col">Month</th>
                            <th scope="col">Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiPengeluaranPerBulanPerCategory as $data)
                        <tr>
                            <th scope="row">{{$data->name}}</th>
                            <td>{{$data->bulan}}</td>
                            <td>{{$data->total}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            <div class="col-12">
                <div class="card table-responsive p-3">
                    <h5>Transaksi Yang Belum diverifikasi</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipe</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Nominal </th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unverifiedTransaction as $data)
                            <tr>
                                <th>{{$data->type == "K"? "Pengeluaran":"Pemasukkan"}}</th>
                                <td>{{date('d M Y', strtotime($data->transaction_date))}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->desc??"-"}}</td>
                                <td>{{$data->nominal}}</td>
                                <td>@if ($data->verified == 0)
                                    <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#verifyModalTransaction" onclick="getTransactionDataToChecked({{ $data->id }})">
                                       Verify
                                    </a>
                                    @else
                                    <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#unverifyModalTransaction" onclick="getTransactionDataToUnchecked({{ $transaction->id }})">
                                        Unverify
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
