<?php

namespace App\Services;

use App\Dto\Api\OrderDto;
use App\Dto\Api\ProductDto;
use App\Dto\Api\ProductHasOrderDto;
use App\Dto\Requests\ProductHasOrderTransferDto;
use App\Exceptions\Api\MessageException;
use App\Interfaces\Api\OrderRepositoryInterface;
use App\Interfaces\Api\ProductHasOrderRepositoryInterface;
use App\Interfaces\Api\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductHasOrderService
{
    protected $productHasOrderRepository;
    protected $productRepository;
    protected $orderRepository;

    public function __construct(ProductHasOrderRepositoryInterface $productHasOrderRepository, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->productHasOrderRepository = $productHasOrderRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getByOrderId(int $orderId): Collection
    {
        $items = $this->productHasOrderRepository->getByOrderId($orderId);
        $result = [];
        foreach ($items as $key => $value) {
            $item = new ProductHasOrderDto($value);
            $item->setProduct(new ProductDto($value->product));
            $result[] = $item;
        }
        return collect($result);
    }

    public function save(array $data): OrderDto
    {
        $orderId = reset($data)->getOrderId();
        $order = new OrderDto($this->orderRepository->find($orderId));

        if ($order->getTotalAmount() > 0) {

            $message = 'No se puede manipular un pedido procesado.';

            throw new MessageException($message, [], 400);
        }

        $totalAmount = 0;
        $clean = [];

        foreach ($data as $value) {
            if ($value instanceof ProductHasOrderTransferDto) {
                $productId = $value->getProductId();

                if (isset($clean[$productId])) {
                    $clean[$productId]->setQuantity($clean[$productId]->getQuantity() + $value->getQuantity());

                } else {
                    $clean[$productId] = $value;
                }
            }
        }
        $data = array_values($clean);

        DB::beginTransaction();
        try {
            foreach ($data as $value) {
                if ($value instanceof ProductHasOrderTransferDto) {
                    $productId = $value->getProductId();
                    $product = new ProductDto($this->productRepository->find($productId));

                    if ($product->getActive() === 1) {
                        $stock = $product->getStock();
                        $quantity = $value->getQuantity();

                        if ($stock >= $quantity) {
                            $fixedPrice = $product->getUnitPrice();

                            $value->setFixedPrice($fixedPrice);
                            $this->productHasOrderRepository->create($value->toTransferArray());

                            $product->setStock($stock - $quantity);
                            $this->productRepository->update($product->toTransferArray(), $productId);

                            $totalAmount += ($fixedPrice * $quantity);
                            continue;
                        }
                    }
                    $message = 'El producto con id 0 no está disponible o está agotado.';

                    throw new MessageException($message, [$productId]);
                }
            }
            DB::commit();

        } catch (Exception $exception) {

            DB::rollBack();

            throw new Exception($exception->getMessage());
        }
        $order->setTotalAmount(round($totalAmount, 2));
        $this->orderRepository->update($order->toTransferArray(), $orderId);
        return new OrderDto(
            $this->orderRepository->find($orderId)
        );
    }
}
