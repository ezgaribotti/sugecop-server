<?php

namespace App\Services;

use App\Dto\Api\AccessTokenDto;
use App\Dto\Api\OperatorDto;
use App\Dto\Requests\CredentialTransferDto;
use App\Exceptions\Api\MessageException;
use App\Interfaces\Api\OperatorRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $operatorRepository;

    public function __construct(OperatorRepositoryInterface $operatorRepository)
    {
        $this->operatorRepository = $operatorRepository;
    }

    public function validateCredentials(CredentialTransferDto $data): AccessTokenDto
    {
        $validOperator = true;
        $operator = null;

        try {
            $operator = $this->operatorRepository->getByUsernameOrInternalCode($data->getUsername());
        } catch (Exception $exception) {
            $validOperator = false;
        }

        if ($operator && $validOperator) {
            if (Hash::check($data->getPassword(), $operator->password)) {
                $accessToken = $operator->createToken('access_token')->plainTextToken;
                $result = new AccessTokenDto();
                $result->setAccessToken($accessToken);
                $result->setOperator(new OperatorDto($operator));
                return $result;
            }
        }

        $message = 'Las credenciales ingresadas no son válidas.';

        throw new MessageException($message, [], 400);
    }
}
