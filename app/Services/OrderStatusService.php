<?php

namespace App\Services;

use App\Dto\Api\OrderStatusDto;
use App\Helpers\DtoHelper;
use App\Interfaces\Api\OrderStatusRepositoryInterface;

class OrderStatusService
{
    protected $orderStatusRepository;

    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function getAll()
    {
        $orderStatuses = $this->orderStatusRepository->all();
        return DtoHelper::collectData($orderStatuses, new OrderStatusDto());
    }
}
