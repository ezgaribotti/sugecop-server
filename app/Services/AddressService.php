<?php

namespace App\Services;

use App\Dto\Api\AddressDto;
use App\Dto\Requests\AddressTransferDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\AddressRepositoryInterface;

class AddressService
{
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getByCustomerId(int $customerId)
    {
        $addresses = $this->addressRepository->getByCustomerId($customerId);

        return DtoHelper::collectData($addresses, new AddressDto());
    }

    public function save(AddressTransferDto $data): AddressDto
    {
        return new AddressDto(
            $this->addressRepository->create($data->toTransferArray())
        );
    }

    public function updatedById(AddressTransferDto $data, $id): void
    {
        $this->addressRepository->update($data->toTransferArray(), $id);
    }

    public function deleteById($id): void
    {
        $this->addressRepository->delete($id);
    }
}
