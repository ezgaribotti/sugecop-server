<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\CategoryTransferDto;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return response()->success(
            $this->categoryService->getAll()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
                Rule::unique('categories', 'name')
            ],
            'active' => [
                'bail',
                'integer',
                Rule::in([0, 1])
            ]
        ]);

        $data = new CategoryTransferDto($validated);

        return response()->success(
            $this->categoryService->save($data)
        );
    }

    public function show(string $id)
    {
        return response()->success(
            $this->categoryService->getById($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'active' => [
                'bail',
                'required',
                'integer',
                Rule::in([0, 1])
            ]
        ]);

        $data = new CategoryTransferDto($validated);

        $this->categoryService->updateById($data, $id);
        return response()->success(
            $this->categoryService->getById($id)
        );

    }

    public function destroy(string $id)
    {
        $this->categoryService->deleteById($id);
        return response()->success();
    }
}
