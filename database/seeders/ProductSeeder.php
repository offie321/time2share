<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Retrieve the user instances to assign as lenders

        // Create dummy products
        Product::create([
            'lender_id' => 1,
            'name' => 'Bank',
            'summary' => 'Een zeer mooie bank',
            'categories' => 'Meubel',
            'image' => 'bank.jpg',
            'days_from_now' => 5
        ]);

        Product::create([
            'lender_id' => 2,
            'name' => 'Stofzuiger',
            'summary' => 'Goedzuigende stofzuiger',
            'categories' => 'Zuigt',
            'image' => 'stofzuiger.jpg',
            'days_from_now' => 12
        ]);

        Product::create([
            'lender_id' => 2,
            'name' => 'Speelgoed auto',
            'summary' => 'Een hele mooie speelgoed auto',
            'categories' => 'Speelgoed',
            'image' => 'speelgoedauto.jpg',
            'days_from_now' => 10
        ]);

        Product::create([
            'lender_id' => 2,
            'name' => 'playstation',
            'summary' => 'Om een avondje leuke spelletjes te spelen',
            'categories' => 'Game console',
            'image' => 'playstation.png',
            'days_from_now' => 3
        ]);

        Product::create([
            'lender_id' => 2,
            'name' => 'Wasmachine',
            'summary' => 'Voor een erg schone was',
            'categories' => 'Wasmachine',
            'image' => 'wasmachine.jpg',
            'days_from_now' => 50
        ]);
    }
}
