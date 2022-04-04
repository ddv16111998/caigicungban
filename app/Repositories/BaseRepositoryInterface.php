<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function get();

    public function find($id, $columns = ['*']);

    public function findOrFail($id);

    public function where($condition, $withs = []);

    public function whereIn($column, $array);

    public function whereNotIn($column, $array);

    public function first();

    public function last();

    public function load($load);

    public function paginator();

    public function orderBy($column, $direction);

    public function limit($offset);

    public function store($data);

    public function update($id, $data);

    public function delete($id);

    public function totalRecord();

    public function getModel();

    public function queryFuncOfModel($func, ... $arg);
}
