<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);

    public function relations($id, array $relations);

    public function update(array $data, $id);

    public function delete($id);

    public function count();
}
