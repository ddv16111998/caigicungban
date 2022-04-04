<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $query;
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $this->model->query();
    }


    public function get($columns = ['*'])
    {
        return $this->query->get();
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();
        return $query->find($id, $columns);
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function findOrFail($id)
    {
        $query = $this->model->newQuery();

        return $query->findOrFail($id);
    }

    /**
     * @param $condition
     * @param array $withs
     * @return $this
     */
    public function where($condition, $withs = [])
    {
        $this->query->with($withs)->where($condition);
        return $this;
    }

    /**
     * @param $column
     * @param $array
     * @return $this
     */
    public function whereIn($column, $array)
    {
        $this->query->whereIn($column, $array);
        return $this;
    }

    /**
     * @param $column
     * @param $array
     * @return $this
     */
    public function whereNotIn($column, $array)
    {
        $this->query->whereNotIn($column, $array);
        return $this;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->query->first();
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return $this->query->latest();
    }

    public function load($load): BaseRepository
    {
        $this->query->load($load);
        return $this;
    }

    public function with(... $load): BaseRepository
    {
        $this->query->with($load);
        return $this;
    }

    public function paginator($perPage = 10, array $columns = ['*'], $page = 1): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->query->paginate($perPage, $columns, 'page', $page);
    }

    public function orderBy($column, $direction)
    {
         $this->query->orderBy($column, $direction);
         return $this;
    }

    public function limit($offset)
    {
        $this->query->limit($offset);
        return $this;
    }

    public function queryRelationship($typeQueryRelationship, $nameRelationship, $callback = null): BaseRepository
    {
        if ($callback){
            $this->query->{$typeQueryRelationship}($nameRelationship, $callback);
        }else{
            $this->query->{$typeQueryRelationship}($nameRelationship);
        }

        return $this;
    }

    public function queryFuncOfModel($func, ... $arg): BaseRepository
    {
        if ($this->query->{$func}->exists()){
            $this->query->{$func}($arg);
        }
        return $this;
    }


    public function whereBetween($column, array $array): BaseRepository
    {
        $this->query->whereBetween($column, $array);
        return $this;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $model = $this->model->newInstance($data);

        $model->save();

        return $model;
    }

    /**
     * @param $id
     * @param $data
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($id, $data)
    {
        $model = $this->findOrFail($id);

        $model->fill($data);

        $model->save();
        $model->refresh();

        return $model;
    }

    /**
     * @param $id
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }

    public function totalRecord()
    {
        return $this->query->count();
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
