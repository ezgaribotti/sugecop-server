<?php

namespace App\Services;

use App\Dto\Api\OrderDto;
use App\Dto\Api\ProductDto;
use App\Dto\Api\OrderDetailDto;
use App\Dto\Requests\OrderDetailTransferDto;
use App\Exceptions\Api\MessageException;
use App\Interfaces\Api\OrderRepositoryInterface;
use App\Interfaces\Api\OrderDetailRepositoryInterface;
use App\Interfaces\Api\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderDetailService
{
    protected $orderDetailRepository;
    protected $productRepository;
    protected $orderRepository;

    public function __construct(OrderDetailRepositoryInterface $orderDetailRepository, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getByOrderId(int $orderId): Collection
    {
        $items = $this->orderDetailRepository->getByOrderId($orderId);
        $result = [];
        foreach ($items as $item) {
            $orderDetail = new OrderDetailDto($item);
            $orderDetail->setProduct(new ProductDto($item->product));
            $result[] = $orderDetail;
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
        $cleanData = [];

        foreach ($data as $value) {
            if ($value instanceof OrderDetailTransferDto) {
                $productId = $value->getProductId();

                if (isset($cleanData[$productId])) {
                    $cleanData[$productId]->setQuantity($cleanData[$productId]->getQuantity() + $value->getQuantity());

                } else {
                    $cleanData[$productId] = $value;
                }
            }
        }
        $data = array_values($cleanData);

        DB::beginTransaction();
        try {
            foreach ($data as $value) {
                if ($value instanceof OrderDetailTransferDto) {
                    $productId = $value->getProductId();
                    $product = new ProductDto($this->productRepository->find($productId));

                    if ($product->getActive() === 1) {
                        $stock = $product->getStock();
                        $quantity = $value->getQuantity();

                        if ($stock >= $quantity) {
                            $fixedPrice = $product->getUnitPrice();

                            $value->setFixedPrice($fixedPrice);
                            $this->orderDetailRepository->create($value->toTransferArray());

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
        } catch (Exception $exception) {

            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        DB::commit();
        $order->setTotalAmount(round($totalAmount, 2));
        $this->orderRepository->update($order->toTransferArray(), $orderId);
        return new OrderDto(
            $this->orderRepository->find($orderId)
        );
    }
}
