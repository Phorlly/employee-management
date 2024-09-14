<?php

namespace App\Http\Helpers;

use App\Http\Helpers\Contract;
use Illuminate\Database\Eloquent\Model;

class Oop implements Contract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function one(int $id)
    {
        return $this->model->find($id);
    }

    public function make(array $data)
    {
        return $this->model->create($data);
    }

    public function modify(int $id, array $data)
    {
        $record = $this->one($id);
        if (!$record) {
            return false;
        }
        $record->update($data);

        return $record;
    }

    public function trash(int $id)
    {
        $record = $this->one($id);
        if (!$record) {
            return false;
        }
        $record->delete();

        return true;
    }

    public function the($model)
    {
        // return $this->model->where($model)->first();
        return $model;
    }

    public function oneAndModify($model, array $data)
    {
        $model->update($data);

        return $model;
    }

    public function oneAndTrash($model)
    {
        $this->model->destroy($model);

        return true;
    }

    public function makes(array $data)
    {
        return $this->model->insert($data);
    }

    public function modifies(array $data)
    {
        foreach ($data as $item) {
            $this->modify($item['id'], $item);
        }

        return true;
    }

    public function trashes(array $ids)
    {
        // foreach ($ids as $id) {
        //     $this->trash($id);
        // }
        $this->model->destroy($ids);

        return true;
    }
}