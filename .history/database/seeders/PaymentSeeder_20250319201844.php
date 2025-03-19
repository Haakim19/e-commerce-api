<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Orders::all()->each(function ($order) {
            Payment::factory()->create(['order_id' => $order->id]);
        });
    }
}
