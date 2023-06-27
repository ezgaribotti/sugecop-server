<?php

namespace App\Services;

use App\Dto\Api\IdentificationDto;
use App\Dto\Api\IdentificationTypeDto;
use App\Dto\Requests\IdentificationTransferDto;
use App\Exceptions\Api\MessageException;
use App\Interfaces\Api\IdentificationRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class IdentificationService
{
    protected $identificationRepository;

    public function __construct(IdentificationRepositoryInterface $identificationRepository)
    {
        $this->identificationRepository = $identificationRepository;
    }

    public function save(IdentificationTransferDto $data): IdentificationDto
    {
        $identification = null;

        try {
            $identification = $this->identificationRepository->validateExistence(
                $data->getIdentificationTypeId(), $data->getNumber()
            );

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return new IdentificationDto(
                    $this->identificationRepository->create($data->toTransferArray())
                );
            }
        }

        if ($identification) {
            $message = 'La identificación 0 ya se encuentra registrada.';

            throw new MessageException($message, [$data->getNumber()], 422);
        }
    }

    public function getByCustomerId(int $customerId): Collection
    {
        $identifications = $this->identificationRepository->getByCustomerId($customerId);

        $result = [];
        foreach ($identifications as $key => $value) {

            $identification = new IdentificationDto($value);
            $identification->setIdentificationType(
                new IdentificationTypeDto($value->identificationType)
            );

            $result[] = $identification;
        }

        return collect($result);
    }

    public function deleteById($id): void
    {
        $this->identificationRepository->delete($id);
    }
}
