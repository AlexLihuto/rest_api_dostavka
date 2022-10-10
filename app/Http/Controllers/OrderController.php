<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Models\Order;

class OrderController extends ApiController
{

    /**
     * OrderController constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @param OrderRequest $request
     * @return mixed
     */
    public function createOrder(OrderRequest $request)
    {

        return $this->create($request);
    }

    /**
     * @param int $entityId
     * @param OrderRequest $request
     * @return mixed
     */
    public function updateOrder(int $entityId, OrderRequest $request)
    {

        return parent::update($entityId, $request);
    }
}
