<?php

namespace App\Services;

use App\Dto\Api\ProductDto;
use App\Dto\Api\ProductListDto;
use App\Dto\Requests\ProductTransferDto;
use App\Exceptions\Api\MessageException;
use App\Helpers\DtoHelper;
use App\Helpers\ImageHelper;
use App\Interfaces\Api\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(): Collection
    {
        $products = $this->productRepository->all();
        return DtoHelper::collectData($products, new ProductListDto());
    }

    public function save(ProductTransferDto $data): ProductDto
    {
        ImageHelper::validateExists($data->getImageName());
        return new ProductDto(
            $this->productRepository->create($data->toTransferArray())
        );
    }

    public function getById($id): ProductDto
    {
        return new ProductDto(
            $this->productRepository->find($id)
        );
    }

    public function updateById(ProductTransferDto $data, $id): void
    {
        $product = new ProductDto($this->productRepository->find($id));

        if ($product->getName() !== $data->getName()) {
            if ($this->productRepository->getByName($data->getName())) {

                $message = 'El nombre del producto ingresado ya está en uso.';

                throw new MessageException($message, [], 422);
            }
        }

        if ($product->getImageName() !== $data->getImageName()) {
            ImageHelper::validateExists($data->getImageName());
            ImageHelper::delete($product->getImageName());
        }

        $this->productRepository->update($data->toTransferArray(), $id);
    }

    public function deleteById($id): void
    {
        $product = new ProductDto($this->productRepository->find($id));
        ImageHelper::delete($product->getImageName());
        $this->productRepository->delete($id);
    }
}
