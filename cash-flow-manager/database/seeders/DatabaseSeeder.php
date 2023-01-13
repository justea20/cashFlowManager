<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        # Insert user data
        DB::table('users')->insert([
            'name' => 'BAPAK',
            'username' => 'bapak',
            'type' => '1',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'ANAK',
            'username' => 'anak',
            'type' => '2',
            'password' => Hash::make('password'),
        ]);

        # Insert category data
        DB::table('categories')->insert([
            'name' => 'Bills',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Education',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Entertainment',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Family',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Foods & Drinks',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Healthcare',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Top Up',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Transportation',
            'type' =>'K'
        ]);
        DB::table('categories')->insert([
            'name' => 'Savings',
            'type' =>'M'
        ]);
        DB::table('categories')->insert([
            'name' => 'Interest',
            'type' =>'M'
        ]);
        DB::table('categories')->insert([
            'name' => 'Income',
            'type' =>'M'
        ]);
        DB::table('categories')->insert([
            'name' => 'Family',
            'type' =>'M'
        ]);
    }
}
