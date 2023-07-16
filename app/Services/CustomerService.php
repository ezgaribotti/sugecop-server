<?php

namespace App\Services;

use App\Dto\Api\CustomerDto;
use App\Dto\Api\CustomerListDto;
use App\Dto\Api\GenderDto;
use App\Dto\Requests\CustomerTransferDto;
use App\Exceptions\Api\MessageException;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll(): Collection
    {
        $customers = $this->customerRepository->all();

        return DtoHelper::collectData($customers, new CustomerListDto());
    }

    public function save(CustomerTransferDto $data): CustomerDto
    {
        return new CustomerDto(
            $this->customerRepository->create($data->toTransferArray())
        );
    }

    public function getById($id): CustomerDto
    {
        $relations = ['gender'];

        $customer = $this->customerRepository->relations($id, $relations);

        $result = new CustomerDto($customer);
        $result->setGender(new GenderDto($customer->gender));

        return $result;
    }

    public function updateById(CustomerTransferDto $data, $id): void
    {
        $customer = new CustomerDto($this->customerRepository->find($id));

        if ($customer->getEmail() !== $data->getEmail()) {
            if ($this->customerRepository->getByEmail($data->getEmail())) {

                $message = 'El correo electrónico ingresado ya está en uso.';

                throw new MessageException($message, [], 422);
            }
        }

        $this->customerRepository->update($data->toTransferArray(), $id);
    }

    public function deleteById($id): void
    {
        $this->customerRepository->delete($id);
    }
}
