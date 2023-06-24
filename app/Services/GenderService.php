<?php

namespace App\Services;

use App\Dto\Api\GenderDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\GenderRepositoryInterface;
use Illuminate\Support\Collection;

class GenderService
{
    protected $genderRepository;

    public function __construct(GenderRepositoryInterface $genderRepository)
    {
        $this->genderRepository = $genderRepository;
    }

    public function getAll(): Collection
    {
        $genders = $this->genderRepository->all();

        return DtoHelper::collectData($genders, new GenderDto());
    }
}
