<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
['name'=>'Capcut Premium','price'=>10000],
['name'=>'Viu Platinum','price'=>5000],
['name'=>'YouTube Premium','price'=>5000],
]);

    }
}
