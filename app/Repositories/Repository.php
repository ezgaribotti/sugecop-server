<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    protected $entity;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    public function all()
    {
        return $this->entity->all();
    }

    public function create(array $data)
    {
        return $this->entity->create($data);
    }

    public function find($id)
    {
        return $this->entity->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return $this->entity->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->entity->findOrFail($id)->delete();
    }

    public function count()
    {
        return $this->entity->count();
    }
}
