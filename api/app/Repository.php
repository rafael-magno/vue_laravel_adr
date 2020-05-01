<?php

namespace App;

use App\Exceptions\ItemNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository
{
    protected $model;

    public function find(int $id): Model
    {
        return $this->model->find($id);
    }

    public function findOrFail(int $id): Model
    {
        $model = $this->model->find($id);

        if (!$model) {
            throw new ItemNotFoundException('Not found.');
        }

        return $model;
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->findOrFail($id);
        $model->update($data);

        return $model;
    }

    public function firstOrCreate(array $data): Model
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete(int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->delete();

        return $model;
    }

    public function findBy(
        array $criteria,
        array $orderBy = [],
        int $limit = 0,
        int $offset = 0
    ): Collection {
        $model = $this->model;

        foreach ($criteria as $field => $value) {
            $operator = is_array($value) ? $value[0] : '=';
            $fieldValue = is_array($value) ? $value[1] : $value;
            $model = $model->where($field, $operator, $fieldValue);
        }

        foreach ($orderBy as $field) {
            $fieldName = is_array($field) ? $field[0] : $field;
            $direction = is_array($field) ? $field[1] : 'asc';
            $model = $model->orderBy($fieldName, $direction);
        }

        if ($limit) {
            $model = $model->take($limit);
            $model = $model->skip($offset);
        }

        return $model->get();
    }

    public function findOneBy(array $criteria): ?Model
    {
        return $this->findBy($criteria)->first();
    }

    public function paginate(int $perPage = 0): LengthAwarePaginator
    {
        $perPage = $perPage ?? $_GET['perPage'] ?? env('PER_PAGE_DEFAULT');

        return $this->model->paginate($perPage)->appends('perPage', $perPage);
    }
}
