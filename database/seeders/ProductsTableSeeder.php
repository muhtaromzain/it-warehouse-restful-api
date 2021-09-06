<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $name = array('Keyboard', 'Mouse', 'Monitor', 'Laptop', 'Gaming Chair', 'PC Set', 'Graphic Card', 'CPU', 'Handphone');
        $brand = array('Samsung', 'Logitech', 'NVidia', 'Corsair', 'Asus ROG', 'Apple', 'Intel', 'Lenovo', 'AMD');
        $category = array('Tools', 'Equipments', 'Spare Parts', 'Unit');
        $colour = array('Red', 'Black', 'Blue', 'Green', 'Transparent', 'Yellow', 'White');
        $condition = array('New', 'Used');
        $desc = array(
            'Bagus banget',
            'Dijamin oke punya performanya',
            'Barang bagus ni bos',
            'Pasti original',
            'Limited Edition',
            'Kualitas terjamin',
            'Mantab bosqu',
            'Produk lokal',
            'Bagus banget ini kak produknya',
            'Premium Quality',
            'High Perfomance',
        );

        $time = Carbon::now();

        for ($x = 0; $x < 100; $x++) {
            $products = [
                "name" => $name[rand(0, 8)],
                "brand" => $brand[rand(0, 8)],
                "category" => $category[rand(0, 3)],
                "price" => rand(10000, 150000),
                "colour" => $colour[rand(0, 6)],
                "condition" => $condition[rand(0, 1)],
                "description" => $desc[rand(0, 10)],
                "created_at" => $time->toDateTimeString(),
                "updated_at" => $time->toDateTimeString(),
            ];

            Product::insert($products);
        }

    }
}
