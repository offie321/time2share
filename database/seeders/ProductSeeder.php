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
            'name' => 'Product 1',
            'summary' => 'Summary of Product 1',
            'categories' => 'Gehakt',
        ]);
    }
}
