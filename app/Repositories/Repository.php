<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Exceptions\Api\CustomMessageException;
use App\Interfaces\RepositoryInterface;
use Exception;

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
        try {
            return $this->entity->create($data);

        } catch (Exception $exception) {

            $message = 'Ocurrió un problema al crear el recurso.';

            throw new CustomMessageException($message);
        }
    }

    public function find($id)
    {
        return $this->entity->findOrFail($id);
    }

    public function update(array $data, $id): void
    {
        $entity = $this->entity->findOrFail($id);
        try {
            $entity->update($data);

        } catch (Exception $exception) {

            $message = 'Ocurrió un problema al actualizar el recurso con id 0.';

            throw new CustomMessageException($message, [$id]);
        }
    }

    public function delete($id): void
    {
        $entity = $this->entity->findOrFail($id);
        try {
            $entity->delete();

        } catch (Exception $exception) {

            $message = 'Ocurrió un problema al borrar el recurso con id 0.';

            throw new CustomMessageException($message, [$id]);
        }
    }

    public function count()
    {
        return $this->entity->count();
    }
}
