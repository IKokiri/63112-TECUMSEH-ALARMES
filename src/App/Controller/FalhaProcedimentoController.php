<?php

namespace App\Controller;

use App\Model\FalhaProcedimentoModel as Model;

class FalhaProcedimentoController {

    private $model;

    function __construct(){
        $this->model = new Model();
    }

    function create($data){
        
        return $this->model->create($data);
    }

    function read($data){
        
        return $this->model->read();
    }

    function readLazy($data){
        
        return $this->model->readLazy();
    }

    function getId($data){
        
        return $this->model->getId($data);
    }

    function update($data){
    
        return $this->model->update($data);
    }

    function delete($request){
        
        return $this->model->delete($request);
    }

}