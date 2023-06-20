<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\OperatorTransferDto;
use App\Http\Controllers\Controller;
use App\Services\OperatorService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperatorController extends Controller
{
    protected $operatorService;

    public function __construct(OperatorService $operatorService)
    {
        $this->operatorService = $operatorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->success(
            $this->operatorService->getAll()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'bail|required|string',
            'internal_code' => [
                'bail',
                'required',
                'string',
                Rule::unique('operators', 'internal_code')
            ],
            'username' => [
                'bail',
                'required',
                'string',
                Rule::unique('operators', 'username')
            ],
            'email' => [
                'bail',
                'required',
                'email:filter',
                Rule::unique('operators', 'email')
            ],
            'password' => 'bail|required|min:8|confirmed'
        ]);

        $data = new OperatorTransferDto($validated);

        return response()->success(
            $this->operatorService->save($data)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->success(
            $this->operatorService->getById($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'full_name' => 'bail|required|string',
            'password' => 'bail|min:8|confirmed',
            'active' => [
                'bail',
                'required',
                'integer',
                Rule::in([0, 1]),
            ]
        ]);

        $data = new OperatorTransferDto($validated);
        $this->operatorService->updateById($data, $id);
        return response()->success(
            $this->operatorService->getById($id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->operatorService->deleteById($id);
        return response()->success();
    }
}
