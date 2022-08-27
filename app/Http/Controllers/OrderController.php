<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws ApiException
     */
    public function index(Request $request): Response
    {
        $orders = $this->orderService->getOrders($request);

        return response()->api(['orders' => $orders], "orders.retrieved", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(OrderStoreRequest $request): Response
    {
        $this->orderService->saveOrder($request);

        return response()->api(null, "order.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $order = $this->orderService->getOrder($id);

        return response()->api(['order' => $order], "order.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(OrderStoreRequest $request): Response
    {
        $order = $this->orderService->updateOrder($request);

        return response()->api(['order' => $order], "order.updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws ApiException
     */
    public function destroy(int $id): Response
    {
        $this->orderService->deleteOrder($id);

        return response()->api(["order" => $id], "order.deleted", 200);
    }
}
