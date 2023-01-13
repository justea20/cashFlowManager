<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Saldo saat ini
        $pemasukan = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','M')
        ->where('verified','!=','0')
        ->sum('nominal');
        $pengeluaran = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','K')
        ->where('verified','!=','0')
        ->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        $transaksiPengeluaranPerBulanPerCategory = Transaction::join('categories','categories.id','=','category_id')
        ->whereRaw('YEAR(transaction_date) = YEAR(NOW())')
        ->where('type','=','K')
        ->where('verified','!=','0')
        ->groupByRaw('name, MONTH(transaction_date)')
        ->select('categories.name', DB::raw('MONTH(transaction_date) as bulan, sum(nominal) as total'))
        ->orderBy('bulan')->get();
        $transaksiPemasukkanPerBulanPerCategory = Transaction::join('categories','categories.id','=','category_id')
        ->whereRaw('YEAR(transaction_date) = YEAR(NOW())')
        ->where('type','=','M')
        ->where('verified','!=','0')
        ->groupByRaw('name, MONTH(transaction_date)')
        ->select('categories.name', DB::raw('MONTH(transaction_date) as bulan, sum(nominal) as total'))
        ->orderBy('bulan')->get();

        //Unverified
        $unverifiedTransaction = Transaction::join('categories','categories.id','=','category_id')
        ->where('verified','=','0')->orderBy('transaction_date')->get();
        // dd($unverifiedTransaction);
        return view('home', compact('saldo','transaksiPemasukkanPerBulanPerCategory','transaksiPengeluaranPerBulanPerCategory','unverifiedTransaction'));
    }
}
