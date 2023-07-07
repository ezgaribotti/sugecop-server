<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\AddressNormalizationTransferDto;
use App\Http\Controllers\Controller;
use App\Services\AddressNormalizationService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddressNormalizationController extends Controller
{
    protected $addressNormalizationService;

    public function __construct(AddressNormalizationService $addressNormalizationService)
    {
        $this->addressNormalizationService = $addressNormalizationService;
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'step' => [
                'bail',
                'required',
                'integer',
                Rule::in([1, 2, 3, 4])
            ]
        ]);

        $data = new AddressNormalizationTransferDto($validated);
        $data->setParameters(array_diff($request->all(), $validated));

        return response()->success(
            $this->addressNormalizationService->normalize($data)
        );
    }
}
