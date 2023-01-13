<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        $pemasukan = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','M')
        ->sum('nominal');
        $pengeluaran = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','P')
        ->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;
        return view('home', compact('saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => ['required'],
            'transaction_date' => ['required'],
            'category_id' => ['required'],
        ]);

        $transaction = new Transaction();
        $transaction->nominal = $request["nominal"];
        $transaction->transaction_date = $request["transaction_date"];
        $transaction->category_id = $request["category_id"];

        if ($transaction->save()) {
            session()->flash("success", "Transaction successfully added");
        } else {
            session()->flash("error", "Transaction failed added");
        }
        return redirect()->back();
    }

    public function verified(Transaction $transaction)
    {
        $transaction->verified = 1;
        if ($transaction->save()) {
            session()->flash("success", "Transaction successfully verified");
        } else {
            session()->flash("error", "Transaction failed to verified");
        }
        return redirect()->back();
    }
    public function unverified(Transaction $transaction)
    {
        $transaction->unverified = 0;
        if ($transaction->save()) {
            session()->flash("success", "Transaction successfully unverified");
        } else {
            session()->flash("error", "Transaction failed to unverified");
        }
        return redirect()->back();
    }
}
