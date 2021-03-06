<?php

namespace Modules\Core\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Core\Exceptions\RepositoryException;

interface BaseRepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @param $model
     * @return mixed
     */
    public function setModel($model);


    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param $relations
     * @return $this|BaseRepositoryInterface
     */
    public function with($relations): BaseRepositoryInterface;

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * @param $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findById($id): Model;

    /**
     * @param $item
     * @param $column
     * @return Model|null
     */
    public function findByColumn($item, $column): ?Model;

    /**
     * @param array $filters
     * @param array $sorts
     * @param int $page
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function advancedPaginate($filters = [], $sorts = [], $page = 1, $limit = 25): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Model
     *
     * @throws RepositoryException
     */
    public function create(array $attributes): Model;

    /**
     * @param Model $model
     * @param array $attributes
     * @return Model
     * @throws RepositoryException
     */
    public function update(Model $model, array $attributes): Model;

    /**
     * @param $id
     * @param array $attributes
     * @return Model
     * @throws ModelNotFoundException|RepositoryException
     */
    public function updateById($id, array $attributes): Model;

    /**
     * @param Model $model
     * @throws RepositoryException
     */
    public function delete(Model $model): void;

    /**
     * @param $id
     * @throws ModelNotFoundException|RepositoryException
     */
    public function deleteById($id): void;

    /**
     * @param $key
     * @param $column
     * @param null $scope
     * @return array
     */
    public function toArray($key, $column, $scope = null): array;

    /**
     * @param $key
     * @param $column
     * @param null $scope
     * @return array
     */
    public function toArrayWithNone($key, $column, $scope = null): array;
}
