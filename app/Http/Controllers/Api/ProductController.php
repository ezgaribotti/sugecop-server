<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\ProductTransferDto;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->success(
            $this->productService->getAll()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
                Rule::unique('products', 'name')
            ],
            'image_name' => 'required',
            'unit_price' => 'required|numeric',
            'category_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('categories', 'id')
            ],
            'active' => [
                'bail',
                'integer',
                Rule::in([0, 1])
            ],
            'stock' => 'required|integer|min:0',
            'description' => 'max:255',
        ]);

        $data = new ProductTransferDto($validated);

        return response()->success(
            $this->productService->save($data)
        );
    }

    public function show(string $id)
    {
        return response()->success(
            $this->productService->getById($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
            ],
            'image_name' => 'required',
            'unit_price' => 'required|numeric',
            'category_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('categories', 'id')
            ],
            'active' => [
                'bail',
                'integer',
                Rule::in([0, 1])
            ],
            'stock' => 'required|integer|min:0',
            'description' => 'max:255',
        ]);

        $data = new ProductTransferDto($validated);

        $this->productService->updateById($data, $id);
        return response()->success(
            $this->productService->getById($id)
        );
    }

    public function destroy(string $id)
    {
        $this->productService->deleteById($id);
        return response()->success();
    }
}
