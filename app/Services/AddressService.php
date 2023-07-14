<?php

namespace App\Services;

use App\Dto\Api\AddressDto;
use App\Dto\Requests\AddressTransferDto;
use App\Helpers\NormalizeAddressHelper;
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

        $result = [];
        foreach ($addresses as $address) {
            $location = new AddressDto($address);
            $locations = [
                $location->getProvince(),
                $location->getDepartment(),
                $location->getLocality(),
                $location->getStreetName()
            ];

            foreach ($locations as $key => $value) {
                if (intval($value)) {
                    $reference = NormalizeAddressHelper::search($key, $value);
                    if ($key === 0) $location->setProvince($reference);
                    if ($key === 1) $location->setDepartment($reference);
                    if ($key === 2) $location->setLocality($reference);
                    if ($key === 3) $location->setStreetName($reference);
                }
            }
            $result[] = $location;
        }
        return collect($result);
    }

    public function save(AddressTransferDto $data): AddressDto
    {
        return new AddressDto(
            $this->addressRepository->create($data->toTransferArray())
        );
    }

    public function deleteById($id): void
    {
        $this->addressRepository->delete($id);
    }
}
