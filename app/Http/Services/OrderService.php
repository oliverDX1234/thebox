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
    protected $packageService;
    protected $productService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PackageService $packageService,
        ProductService $productService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->packageService = $packageService;
        $this->productService = $productService;
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
            $order->manual = 1;

            $order->save();

            $this->addOrderPackages($request->packages, $request->type_of_packages, $order);

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

            $order->update($request->except("id"));

            $order->user_shipping_details = json_encode($request->user_shipping_details);

            $order->save();
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

    /**
     * @throws ApiException
     */
    private function createOrderPackage($package)
    {
        $dbPackage = Package::create([
            "pre_made" => 0
        ]);

        $totalPrice = 0;

        foreach ($package["products"] as $product) {;

            $totalPrice += $this->productService->getProductPrice($product["id"])["price"] * $product["quantity"];

            $dbPackage->products()->attach($product["id"], ["quantity" => $product["quantity"]]);
        }

        $dbPackage->price = $totalPrice;

        $dbPackage->save();

        return $dbPackage;
    }

    /**
     * @throws ApiException
     */
    private function addOrderPackages($packages, $typeOfPackages, $order)
    {

        if($typeOfPackages === "existing"){

            $totalPrice = 0;

            foreach ($packages as $package) {

                $priceArr = $this->packageService->getPackagePrice($package["id"]);
                echo($priceArr["price"]);
                $totalPrice += $priceArr["price"] * $package["quantity"];

                $order->packages()->attach(
                    $package["id"],
                    [
                        "quantity" => $package["quantity"],
                        "package_name" => $package["name"],
                        "package_price" => $priceArr["price"],
                        "package_price_no_vat" => $priceArr["price_no_vat"]
                    ]
                );
            }

            $order->total_price = $totalPrice;

            $order->save();
        }else{

            foreach ($packages as $package) {
                $createdPackage = $this->createOrderPackage($package);

                $order->packages()->attach(
                    $createdPackage->id,
                    [
                        "quantity" => 1,
                        "package_name" => $createdPackage->name,
                        "package_price" => $createdPackage->price_discount ?? $createdPackage->price,
                        "package_price_no_vat" => $createdPackage->price_no_vat
                    ]);
            }
        }
    }

}
