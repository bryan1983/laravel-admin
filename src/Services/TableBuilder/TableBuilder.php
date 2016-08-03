<?php

namespace Joselfonseca\LaravelAdmin\Services\TableBuilder;

/**
 * Class TableBuilder
 * @package Joselfonseca\LaravelAdmin\Services\TableBuilder
 */
class TableBuilder
{
    /**
     * @var
     */
    private $model;
    /**
     * @var
     */
    private $twig;
    /**
     * @var array
     */
    private $actions = [];

    /**
     *
     */
    public function __construct()
    {
        $this->setTwig();
    }

    /**
     * Set the twig env
     * @return $this
     */
    private function setTwig()
    {
        if (!is_dir(storage_path('twig'))) {
            mkdir(storage_path('twig'), 777);
        }
        $this->loader = new \Twig_Loader_Filesystem([__DIR__.'/Templates'],
            [
            'cache' => storage_path('twig'),
            'debug' => true
        ]);
        $this->twig   = new \Twig_Environment($this->loader);
        $function     = new \Twig_SimpleFunction('replace_id',
            function ($subject, $value) {
            return str_replace('-id-', $value, $subject);
        });
        $this->twig->addFunction($function);
        return $this;
    }

    /**
     * Set the model
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Set the actions for the table
     * @param array $array
     */
    public function setActions(array $array = [])
    {
        $this->actions = $array;
    }

    /**
     * Render the table
     * @return mixed
     */
    public function render()
    {
        return $this->twig->render('table.html', [
            'fields' => $this->model->getFields(),
            'rows' => $this->model->getRows(),
            'actions' => $this->actions
        ]);
    }
}
