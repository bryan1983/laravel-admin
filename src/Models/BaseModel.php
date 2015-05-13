<?php 

namespace Joselfonseca\LaravelAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    public function getFields(){
        return [];
    }
    
    public function getRows(){
        return [];
    }

}