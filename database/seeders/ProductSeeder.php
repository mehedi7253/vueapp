<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_name'  => 'test product 1',
                'slug'          => 'test-product-1',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 2',
                'slug'          => 'test-product-2',
                'price'         => '1000',
                'discount_price' => null,
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 3',
                'slug'          => 'test-product-3',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 4',
                'slug'          => 'test-product-4',
                'price'         => '500',
                'discount_price' => null,
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 5',
                'slug'          => 'test-product-5',
                'price'         => '2000',
                'discount_price' => '1500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 6',
                'slug'          => 'test-product-6',
                'price'         => '3000',
                'discount_price' => null,
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 7',
                'slug'          => 'test-product-7',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 8',
                'slug'          => 'test-product-8',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 9',
                'slug'          => 'test-product-9',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 10',
                'slug'          => 'test-product-10',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 11',
                'slug'          => 'test-product-11',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_name'  => 'test product 12',
                'slug'          => 'test-product-12',
                'price'         => '1000',
                'discount_price' => '500',
                'status'        => 1,
                'thumbnail'     => 'uploads/product/test.jpg',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
