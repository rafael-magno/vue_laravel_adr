<?php

namespace App;

use App\Exceptions\HttpResponseException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            abort(404);
        }

        return $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->findOrFail($id);
        $model->update($data);

        return $model;
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            abort(404);
        }

        try {
            $model->delete();
        } catch (QueryException $queryException) {
            throw new HttpResponseException('["The record is linked to another item"]', 422, $queryException);
        }

        return $model;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $model = $this->model;

        if (1 == count($criteria)) {
            foreach ($criteria as $c) {
                $model = $model->where($c[0], $c[1], $c[2]);
            }
        } elseif (count($criteria > 1)) {
            $model = $model->where($criteria[0], $criteria[1], $criteria[2]);
        }

        if (1 == count($orderBy)) {
            foreach ($orderBy as $order) {
                $model = $model->orderBy($order[0], $order[1]);
            }
        } elseif (count($orderBy > 1)) {
            $model = $model->orderBy($orderBy[0], $orderBy[1]);
        }

        if (count($limit)) {
            $model = $model->take((int) $limit);
        }

        if (count($offset)) {
            $model = $model->skip((int) $offset);
        }

        return $model->get();
    }

    public function findOneBy(array $criteria)
    {
        return $this->findBy($criteria)->first();
    }

    public function paginate($perPage = null)
    {
        $perPage = $perPage ?? $_GET['perPage'] ?? env('PER_PAGE_DEFAULT');

        return $this->model->paginate($perPage)->appends('perPage', $perPage);
    }
}
