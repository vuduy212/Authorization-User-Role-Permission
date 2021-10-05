<?php


namespace App\Repositories;


abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    public function makeModel()
    {
        $this->model = app($this->model());
    }

    abstract function model();

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
