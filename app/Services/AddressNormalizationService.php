<?php

namespace App\Services;

use App\Dto\Requests\AddressNormalizationTransferDto;
use App\Helpers\AddressNormalizationHelper;

class AddressNormalizationService
{
    public function normalize(AddressNormalizationTransferDto $data)
    {
        return AddressNormalizationHelper::sendHttp($data);
    }
}
