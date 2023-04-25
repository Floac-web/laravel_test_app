<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::insert([
            ['number' => '978', 'locale' => 'eu', 'code' =>'EUR' , 'name' => 'Euro', 'symbol' => '€' ],
            ['number' => '840', 'locale' => 'en', 'code' =>'USD' , 'name' => 'US Dollar', 'symbol' => '$' ],
            ['number' => '980', 'locale' => 'uk', 'code' =>'UAH' , 'name' => 'Hryvnia', 'symbol' => '₴' ],
            ['number' => '985', 'locale' => 'pl', 'code' =>'PLN' , 'name' => 'Zloty', 'symbol' => 'z' ],
        ]);
    }
}
