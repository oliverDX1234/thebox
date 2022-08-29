<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Package;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class OrderService
{
    protected $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @throws ApiException
     */
    public function getOrders($request)
    {
        try {
            return $this->orderRepository->getOrders($request);
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getOrder(int $id): Order
    {
        try {
            return $this->orderRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("orders.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function saveOrder($request)
    {
        try {

            $order = Order::make($request->except("id"));

            $order->user_shipping_details = json_encode($request->user_shipping_details);

            $order->save();

            if($request->products){
                $this->createOrderPackage($request->products, $order);
            }else{
                $this->addOrderPackages($request->packages, $order);
            }
        } catch (Exception $e) {

            throw new ApiException("orders.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateOrder($request): Order
    {

        try {
            $order = $this->orderRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("orders.not_found", $e->getCode(), $e);
        }

        try {
            $order->update($request->all());

            $order->user_shipping_details = json_encode($request->user_shipping_details);

            $order->save();

            return $order;
        } catch (Exception $e) {

            throw new ApiException("orders.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteOrder($id)
    {
        try {
            $this->orderRepository->deleteOrder($id);
        } catch (Exception $e) {
            throw new ApiException("orders.not_found", $e->getCode(), $e);
        }
    }

    private function createOrderPackage($products, $order)
    {
        $package = Package::create([
            "pre_made" => 0
        ]);

        foreach($products as $product){

            $package->products()->attach($product["id"], ["quantity" => $product["quantity"]]);
        }

        $package->price = array_reduce($products, function ($sum, $item)
        {
            $sum += $item["price_discount"] ?? $item["price"];

            return $sum;
        });

        $package->save();

        $order->packages()->attach($package->id, ["quantity" => 1]);
    }

    private function addOrderPackages($packages, $order)
    {
        foreach($packages as $package){
            $order->packages()->attach($package["id"], ["quantity" => $package["quantity"]]);
        }

        $order->total_price = array_reduce($packages, function($sum, $item){
            $sum += $item["price_discount"] ?? $item["price"];

            return $sum;
        });

        $order->save();
    }

}
