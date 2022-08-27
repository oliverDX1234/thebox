<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Package;
use App\Models\TempOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TempOrder::factory(20, [])->create();

        foreach (TempOrder::all() as $order) {

            $addedPackageIds = [];

            for($i = 0; $i < rand(1, 5); $i++){
                while(true){
                    $package = Package::all()->random();
                    if(!in_array($package->id, $addedPackageIds)){
                        break;
                    }
                }

                DB::table('temp_order_package')->insert(array('temp_order_id' => $order->id, 'package_id' => $package->id, "quantity" => rand(1, 2), "package_name" => $package->name, "package_price" => $package->price_discount ?? $package->price, "package_price_no_vat" => $package->getPriceNoVat()));
            }

        }

        Order::factory(50, [])->create();

        foreach (Order::all() as $order) {

            $addedPackageIds = [];

            for($i = 0; $i < rand(1, 5); $i++){

                while(true){
                    $package = Package::all()->random();
                    if(!in_array($package->id, $addedPackageIds)){
                        break;
                    }
                }

                DB::table('order_package')->insert(array('order_id' => $order->id, 'package_id' => $package->id, "quantity" => rand(1, 2), "package_name" => $package->name, "package_price" => $package->price_discount ?? $package->price, "package_price_no_vat" => $package->getPriceNoVat()));
            }

        }

        foreach(TempOrder::where("success", "=", 1)->get() as $tempOrder){
            $order = Order::factory()->create([
                "payment_type" => "card",
                "paid" => 1,
                "user_id" => $tempOrder->user_id,
                "courier_id" => $tempOrder->courier_id,
                "total_price" => $tempOrder->total_price,
                "total_price_no_vat" => $tempOrder->total_price_no_vat,
                "delivery_price" => $tempOrder->delivery_price,
                "user_shipping_details" => $tempOrder->user_shipping_details,
                "checksum" => $tempOrder->checksum
            ]);

            foreach($tempOrder->packages as $package){

                DB::table('order_package')->insert(array('order_id' => $order->id, 'package_id' => $package->id, "quantity" => $package->pivot->quantity, "package_name" => $package->pivot->package_name, "package_price" => $package->pivot->package_price, "package_price_no_vat" => $package->pivot->package_price_no_vat));

            }
        }
    }
}
