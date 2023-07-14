<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\AddressTransferDto;
use App\Http\Controllers\Controller;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('customers', 'id')
            ]
        ]);

        $data = new AddressTransferDto($validated);

        return response()->success(
            $this->addressService->getByCustomerId($data->getCustomerId())
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('customers', 'id')
            ],
            'province' => 'required',
            'department' => 'required',
            'locality' => 'required',
            'street_name' => 'required',
            'street_number' => 'required|integer',
            'postal_code' => 'required',
            'reference' => 'max:255'
        ]);

        $data = new AddressTransferDto($validated);

        return response()->success(
            $this->addressService->save($data)
        );
    }

    public function destroy(string $id)
    {
        $this->addressService->deleteById($id);
        return response()->success();
    }
}
