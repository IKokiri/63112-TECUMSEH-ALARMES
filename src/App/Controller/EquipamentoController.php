<?php

namespace App\Controller;

use App\Model\EquipamentoModel as Model;

class EquipamentoController {

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