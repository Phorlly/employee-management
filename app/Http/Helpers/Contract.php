<?php

namespace App\Http\Helpers;

interface Contract
{
    //Base Interface Global
    public function all();

    public function one(int $id);

    public function make(array $data);

    public function modify(int $id, array $data);

    public function trash(int $id);

    //Additional Interface Methods
    public function the($model);

    public function oneAndModify($model, array $data);

    public function oneAndTrash($model);

    // public function search(string $search);
    // public function paginate(int $perPage);

    //method to can do more than one
    public function makes(array $data);

    public function modifies(array $data);

    public function trashes(array $ids);
}