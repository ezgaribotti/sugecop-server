<?php

namespace App\Http\Controllers\Api;

use App\Dto\Requests\NormalizeAddressTransferDto;
use App\Http\Controllers\Controller;
use App\Services\NormalizeAddressService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NormalizeAddressController extends Controller
{
    protected $normalizeAddressService;

    public function __construct(NormalizeAddressService $normalizeAddressService)
    {
        $this->normalizeAddressService = $normalizeAddressService;
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'bail',
                'required',
                'integer',
                Rule::in([1, 2, 3, 4])
            ]
        ]);

        $data = new NormalizeAddressTransferDto($validated);
        $data->setParameters(array_diff($request->all(), $validated));

        return response()->success(
            $this->normalizeAddressService->normalize($data)
        );
    }
}
