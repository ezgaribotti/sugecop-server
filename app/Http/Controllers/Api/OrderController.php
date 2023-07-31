<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\OrderTransferDto;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return response()->success(
            $this->orderService->getAll()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_status_id' => [
                Rule::exists('order_statuses', 'id')
            ],
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')
            ],
            'identification_id' => [
                'required',
                Rule::exists('identifications', 'id')
            ],
            'shipping_address_id' => [
                'required',
                Rule::exists('addresses', 'id')
            ],
            'observation' => 'string|max:255',
        ]);

        $data = new OrderTransferDto($validated);

        return response()->success(
            $this->orderService->save($data)
        );
    }

    public function show(string $id)
    {
        return response()->success(
            $this->orderService->getById($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order_status_id' => [
                'required',
                Rule::exists('order_statuses', 'id')
            ],
            'shipping_address_id' => [
                'required',
                Rule::exists('addresses', 'id')
            ],
            'observation' => 'string|max:255',
        ]);

        $data = new OrderTransferDto($validated);

        $this->orderService->updateById($data, $id);
        return response()->success(
            $this->orderService->getById($id)
        );
    }

    public function destroy(string $id)
    {
        $this->orderService->deleteById($id);
        return response()->success();
    }
}
