<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('2'),
        ]);
        User::factory(10)->create();

        Category::factory(5)->create();

        Product::factory(30)->create();

        Order::factory(50)->create();

        Order::all()->each(function ($order) {

            $itemsCount = rand(1, 5);

            $total = 0;

            for ($i = 0; $i < $itemsCount; $i++) {

                $product = Product::inRandomOrder()->first();

                $quantity = rand(1, 3);

                $subtotal = $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update([
                'total_price' => $total,
            ]);
        });
    }
}
