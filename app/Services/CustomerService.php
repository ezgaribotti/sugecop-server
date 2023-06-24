<?php

namespace App\Services;

use App\Dto\Api\CustomerDto;
use App\Dto\Api\CustomerListDto;
use App\Dto\Api\GenderDto;
use App\Dto\Requests\CustomerTransferDto;
use App\Exceptions\Api\MessageException;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\CustomerRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $customerFound = false;
        $customer = $this->customerRepository->find($id);

        if ($customer->email === $data->getEmail()) {
            $this->customerRepository->update($data->toTransferArray(), $id);

        } else {
            try {
                $this->customerRepository->getByEmail($data->getEmail());
                $customerFound = true;

            } catch (Exception $exception) {
                if ($exception instanceof ModelNotFoundException) {
                    $this->customerRepository->update($data->toTransferArray(), $id);
                }
            }
        }

        if ($customerFound) {
            $message = 'El correo electrónico ingresado ya está en uso.';

            throw new MessageException($message, [], 422);
        }
    }

    public function deleteById($id): void
    {
        $this->customerRepository->delete($id);
    }
}
