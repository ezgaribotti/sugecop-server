<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\IdentificationTransferDto;
use App\Http\Controllers\Controller;
use App\Services\IdentificationService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IdentificationController extends Controller
{
    protected $identificationService;

    public function __construct(IdentificationService $identificationService)
    {
        $this->identificationService = $identificationService;
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

        $data = new IdentificationTransferDto($validated);

        return response()->success(
            $this->identificationService->getByCustomerId($data->getCustomerId())
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
            'identification_type_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('identification_types', 'id')
            ],
            'number' => 'required'
        ]);

        $data = new IdentificationTransferDto($validated);

        return response()->success(
            $this->identificationService->save($data)
        );
    }

    public function destroy(string $id)
    {
        $this->identificationService->deleteById($id);
        return response()->success();
    }
}
