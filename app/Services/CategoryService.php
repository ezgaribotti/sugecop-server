<?php

namespace App\Services;

use App\Dto\Api\CategoryDto;
use App\Dto\Requests\CategoryTransferDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $categories = $this->categoryRepository->all();

        return DtoHelper::collectData($categories, new CategoryDto());
    }

    public function save(CategoryTransferDto $data): CategoryDto
    {
        return new CategoryDto(
            $this->categoryRepository->create($data->toTransferArray())
        );
    }

    public function getById($id): CategoryDto
    {
        return new CategoryDto(
            $this->categoryRepository->find($id)
        );
    }

    public function updateById(CategoryTransferDto $data, $id): void
    {
        $this->categoryRepository->update($data->toTransferArray(), $id);
    }

    public function deleteById($id): void
    {
        $this->categoryRepository->delete($id);
    }
}
