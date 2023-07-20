<?php

namespace App\Services;

use App\Dto\Api\OrderDto;
use App\Dto\Api\OrderListDto;
use App\Dto\Api\OrderStatusDto;
use App\Dto\Requests\OrderTransferDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAll(): Collection
    {
        $orders = $this->orderRepository->all();
        return DtoHelper::collectData($orders, new OrderListDto());
    }

    public function save(OrderTransferDto $data): OrderDto
    {
        $orderNumber = chr(rand(65, 90)) . now()->timestamp;

        $data->setOrderNumber($orderNumber);
        $data->setTotalAmount(0);

        if (!$data->getOrderStatusId()) $data->setOrderStatusId(1);

        return new OrderDto(
            $this->orderRepository->create($data->toTransferArray())
        );
    }

    public function getById($id): OrderDto
    {
        $relations = ['orderStatus'];

        $order = $this->orderRepository->relations($id, $relations);

        $result = new OrderDto($order);
        $result->setOrderStatus(new OrderStatusDto($order->orderStatus));

        return $result;
    }

    public function updateById(OrderTransferDto $data, $id): void
    {
        $this->orderRepository->update($data->toTransferArray(), $id);
    }

    public function deleteById($id): void
    {
        $this->orderRepository->delete($id);
    }
}
