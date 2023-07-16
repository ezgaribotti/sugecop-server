<?php

namespace App\Services;

use App\Dto\Api\ProductDto;
use App\Dto\Api\ProductListDto;
use App\Dto\Requests\ProductTransferDto;
use App\Exceptions\Api\MessageException;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\ProductRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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
        $path = config('filesystems.storages.image');

        $fullPath = $path . chr(47) . $data->getImageName();

        if (!Storage::exists($fullPath)) {

            $message = 'Imagen no encontrada en el almacenamiento.';

            throw new MessageException($message, [], 422);

        }

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
        $productFound = false;
        $product = $this->productRepository->find($id);

        if ($product->name === $data->getName()) {
            $this->productRepository->update($data->toTransferArray(), $id);

        } else {
            try {
                $this->productRepository->getByName($data->getName());
                $productFound = true;

            } catch (Exception $exception) {
                if ($exception instanceof ModelNotFoundException) {
                    $this->productRepository->update($data->toTransferArray(), $id);
                }
            }
        }

        if ($productFound) {
            $message = 'El nombre del producto ingresado ya está en uso.';

            throw new MessageException($message, [], 422);
        }
    }

    public function deleteById($id): void
    {
        $this->productRepository->delete($id);
    }
}
