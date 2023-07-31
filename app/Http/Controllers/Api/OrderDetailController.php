<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\OrderDetailTransferDto;
use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderDetailController extends Controller
{
    protected $orderDetailService;

    public function __construct(OrderDetailService $orderDetailService)
    {
        $this->orderDetailService = $orderDetailService;
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'order_id' => [
                'required',
                'integer',
                Rule::exists('orders', 'id')
            ]
        ]);

        $data = new OrderDetailTransferDto($validated);

        return response()->success(
            $this->orderDetailService->getByOrderId($data->getOrderId())
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => [
                'required',
                'integer',
                Rule::exists('orders', 'id')
            ],
            'items' => 'required|array|min:1|max:20',
            'items.*.product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id'),
            ],
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $data = [];
        foreach ($request->items as $item) {
            $data[] = new OrderDetailTransferDto(array_merge($item, $validated));
        }

        return response()->success(
            $this->orderDetailService->save($data)
        );
    }
}
