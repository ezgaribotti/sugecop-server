<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\ProductHasOrderTransferDto;
use App\Http\Controllers\Controller;
use App\Services\ProductHasOrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductHasOrderController extends Controller
{
    protected $productHasOrderService;

    public function __construct(ProductHasOrderService $productHasOrderService)
    {
        $this->productHasOrderService = $productHasOrderService;
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

        $data = new ProductHasOrderTransferDto($validated);

        return response()->success(
            $this->productHasOrderService->getByOrderId($data->getOrderId())
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
            $data[] = new ProductHasOrderTransferDto(array_merge($item, $validated));
        }

        return response()->success(
            $this->productHasOrderService->save($data)
        );
    }
}
