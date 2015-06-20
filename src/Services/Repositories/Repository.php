<?php


namespace Joselfonseca\LaravelAdmin\Services\Repositories;

use Bosnadev\Repositories\Eloquent\Repository as Repo;

/**
 * Class Repository
 * @package Joselfonseca\LaravelAdmin\Services\Repositories
 * @link http://bosnadev.com/2015/03/26/using-repository-pattern-in-laravel-5-eloquent-relations-and-eager-loading/
 */
abstract class Repository extends Repo{


    /**
     * Set up the relations to be include in the query
     * @param $relations
     * @return $this
     */
    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

    /**
     * Eager Loading
     * @return $this
     */
    protected function eagerLoadRelations() {
        if(!is_null($this->with)) {
            foreach ($this->with as $relation) {
                $this->model->with($relation);
            }
        }
        return $this;
    }

    /**
     * GetAll
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->get($columns);
    }


}