<?php

namespace App\Services;

use App\Dto\Requests\NormalizeAddressTransferDto;
use App\Helpers\NormalizeAddressHelper;

class NormalizeAddressService
{
    public function normalize(NormalizeAddressTransferDto $data)
    {
        $data->setType($data->getType() - 1);

        return NormalizeAddressHelper::sendHttp($data);
    }
}
