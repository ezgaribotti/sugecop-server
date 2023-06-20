<?php

namespace App\Services;

use App\Dto\Api\OperatorDto;
use App\Dto\Api\OperatorListDto;
use App\Dto\Requests\OperatorTransferDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\OperatorRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class OperatorService
{
    protected $operatorRepository;

    public function __construct(OperatorRepositoryInterface $operatorRepository)
    {
        $this->operatorRepository = $operatorRepository;
    }

    public function getAll(): Collection
    {
        $operators = $this->operatorRepository->all();

        return DtoHelper::collectData($operators, new OperatorListDto());
    }

    public function save(OperatorTransferDto $data): OperatorDto
    {
        $data->setPassword(Hash::make($data->getPassword()));

        return new OperatorDto(
            $this->operatorRepository->create($data->toArray())
        );
    }

    public function getById($id): OperatorDto
    {
        return new OperatorDto(
            $this->operatorRepository->find($id)
        );
    }

    public function updateById(OperatorTransferDto $data, $id): void
    {
        if ($data->getPassword()) {
            $data->setPassword(Hash::make($data->getPassword()));
        }

        $this->operatorRepository->update($data->toArray(), $id);
    }

    public function deleteById($id): void
    {
        $this->operatorRepository->delete($id);
    }
}
