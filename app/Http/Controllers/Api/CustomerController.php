<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\CustomerTransferDto;
use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return response()->success(
            $this->customerService->getAll()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'bail',
                'required',
                'email:filter',
                Rule::unique('customers', 'email')
            ],
            'phone_number' => 'required|string',
            'gender_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('genders', 'id')
            ]
        ]);

        $data = new CustomerTransferDto($validated);

        return response()->success(
            $this->customerService->save($data)
        );
    }

    public function show(string $id)
    {
        return response()->success(
            $this->customerService->getById($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'bail',
                'required',
                'email:filter',
            ],
            'phone_number' => 'required|string',
            'gender_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('genders', 'id')
            ]
        ]);

        $data = new CustomerTransferDto($validated);
        $this->customerService->updateById($data, $id);
        return response()->success(
            $this->customerService->getById($id)
        );
    }

    public function destroy(string $id)
    {
        $this->customerService->deleteById($id);
        return response()->success();
    }
}
