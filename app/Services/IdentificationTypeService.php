<?php

namespace App\Services;

use App\Dto\Api\IdentificationTypeDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\IdentificationTypeRepositoryInterface;
use Illuminate\Support\Collection;

class IdentificationTypeService
{
    protected $identificationTypeRepository;

    public function __construct(IdentificationTypeRepositoryInterface $identificationTypeRepository)
    {
        $this->identificationTypeRepository = $identificationTypeRepository;
    }

    public function getAll(): Collection
    {
        $identificationTypes = $this->identificationTypeRepository->all();

        return DtoHelper::collectData($identificationTypes, new IdentificationTypeDto());
    }
}
