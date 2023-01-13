<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Transaction extends Model
{
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function saldo(){
        $pemasukan = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','M')
        ->sum('nominal');
        $pengeluaran = Transaction::join('categories','categories.id','=','category_id')
        ->where('type','=','P')
        ->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;
        return $saldo;
    }

}
