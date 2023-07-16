<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class CategoryDto extends Dto
{
    protected int $id;
    protected string $name;
    protected int $active;
    protected string $created_at;
    protected string $updated_at;
}
