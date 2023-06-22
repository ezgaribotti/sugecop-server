<?php

namespace App\Http\Controllers\Api;

use App\Dto\Api\OperatorDto;
use App\Dto\Requests\CredentialTransferDto;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'bail|required|min:8'
        ]);

        $data = new CredentialTransferDto($validated);

        return response()->success(
            $this->authService->validateCredentials($data)
        );
    }

    public function operatorProfile(Request $request)
    {
        return response()->success(
            new OperatorDto($request->user())
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->success();
    }
}
