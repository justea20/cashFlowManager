<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Category extends Model
{
    public function transactions()
    {
      return $this->hasMany(Transaction::class);
    }

    public static function category_pemasukkan()
    {
        $categories = Transaction::where('type','=','M')->get();
        return $categories;
    }
    public function category_pengeluaran()
    {
        $categories = Transaction::where('type','=','K')->get();
        return $categories;
    }
}
