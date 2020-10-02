<?php

namespace App\Model;

use App\DAO\Database;
use App\Core\Model;
use PDO;


class FalhaModel extends Model{

    private $table = "falhas";
    private $model = "FalhaModel";

    function read(){
        
        $sql = "SELECT * FROM ".$this->table;

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function getId($data){
        
        $this->populate($data);

        $sql = "SELECT * FROM ".$this->table." 
        WHERE id = :id;";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':id', $this->id, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model getId) o registro $this->id");

        return $result;
    }

    function create($data){
        
        $this->populate($data);
        
        $sql = "INSERT INTO ".$this->table." 
                    (
                    tag,
                    falha,
                    id_mensagem,
                    criado)
                    VALUES
                    (
                    :tag,
                    :falha,
                    :id_mensagem,
                    CURRENT_TIMESTAMP)";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':tag', $this->tag, PDO::PARAM_STR);
        $query->bindValue(':falha', $this->falha, PDO::PARAM_STR);
        $query->bindValue(':id_mensagem', $this->id_mensagem, PDO::PARAM_STR);
        
        $result = Database::executa($query); 
          
        $this->log->setInfo("Criou ($this->model create) o registro ". $this->conn->lastInsertId());

        return $result;
    }

    function update($data){

        $this->populate($data);

        $sql = "UPDATE ".$this->table." 
                SET
                tag = :tag,
                falha = :falha,
                id_mensagem = :id_mensagem,
                editado = CURRENT_TIMESTAMP
                WHERE id = :id;";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id', $this->id, PDO::PARAM_STR);
        $query->bindValue(':tag', $this->tag, PDO::PARAM_STR);        
        $query->bindValue(':id_mensagem', $this->id_mensagem, PDO::PARAM_STR);
        $query->bindValue(':falha', $this->falha, PDO::PARAM_STR);  
      
        $result = Database::executa($query);   

        $this->log->setInfo("Atualizaou ($this->model update) o registro $this->id");

        return $result;
    }

    function delete($data){

        $this->populate($data);

        $sql = "DELETE FROM ".$this->table." 
                    WHERE id = :id;";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id', $this->id, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Removeu ($this->model delete) o registro $this->id");
        
        return $result;
    }

    function readJoin(){
        
        $sql = "SELECT fal.*,men_fal.mensagem FROM ".$this->table." fal
        inner join mensagem_falhas men_fal
        on fal.id_mensagem = men_fal.id";

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    
    function filter($data){
        
        $this->populate($data);
        
        $sql = "SELECT fal.*,men_fal.mensagem FROM ".$this->table." fal
        inner join mensagem_falhas men_fal
        on fal.id_mensagem = men_fal.id where tag LIKE :term1 or falha LIKE :term2 or mensagem LIKE :term3";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':term1', "%".$this->term1."%", PDO::PARAM_STR);
        $query->bindValue(':term2', "%".$this->term2."%", PDO::PARAM_STR);
        $query->bindValue(':term3', "%".$this->term3."%", PDO::PARAM_STR);

        $result = Database::executa($query);     

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

}

  