<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
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
            throw new ApiException("order.not_found", $e->getCode(), $e);
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

            $order = Order::make($request->except(['image', 'active', '_method']));

            $order->active = json_decode($request->active);

            $order->save();

            if ($request->file('imageInput')) {
                $order->addMediaFromRequest("imageInput")
                    ->toMediaCollection("avatar");
                $order->image = $order->getFirstMedia("avatar")->getUrl();
            } else {
                $order->image = env("APP_URL") . "/images/upload.png";
            }


            $order->save();
        } catch (Exception $e) {
            throw new ApiException("order.save_failed", 500, null, $e);
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
            throw new ApiException("order.not_found", $e->getCode(), $e);
        }

        try {

            $order->update($request->except(['image', 'active', '_method']));

            $order->active = json_decode($request->active);

            if ($request->file('imageInput')) {
                $order->addMediaFromRequest("imageInput")
                    ->toMediaCollection("avatar");
                $order->image = $order->getFirstMedia("avatar")->getUrl();
            }

            $order->save();

            return $order;
        } catch (Exception $e) {
            throw new ApiException("order.update_failed", 500, null, $e);
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
            throw new ApiException("order.not_found", $e->getCode(), $e);
        }
    }

}
