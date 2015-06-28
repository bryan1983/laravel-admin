<?php


namespace Joselfonseca\LaravelAdmin\Services\Slug;


/**
 * Class SlugGeneratorObserver
 * @package App\Services\Slug
 */
class SlugGeneratorObserver {

    use SlugGeneratorTrait;

    /**
     * @var
     */
    public $model;

    /**
     * @param $model
     */
    public function saving($model) {
        $this->model = $model;
        if(!isset($this->model->title)){
            $title = $this->model->name;
        }else{
            $title = $this->model->title;
        }
        if(!isset($this->model->id)){
            $this->model->slug = $this->generateSlug($title);
        }
    }

    /**
     * @param $model
     */
    public function updating($model)
    {
        $this->model = $model;
        if(!isset($this->model->title)){
            $title = $this->model->name;
        }else{
            $title = $this->model->title;
        }
        if(isset($model->generateNewSlug) && $model->generateNewSlug === true){
            $this->model->slug = $this->generateSlug($title);
            unset($model->generateNewSlug);
        }
    }
}