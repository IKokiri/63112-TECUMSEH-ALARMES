<?php

namespace App\Model;

use App\DAO\Database;
use App\Core\Model;
use PDO;

class EquipamentoFalhaModel extends Model{

    private $table = "`tecumsehalarmes63112`.`equipamento_falhas`";
    private $model = "EquipamentoFalhaModel";

    function read(){
        
        $sql = "SELECT * FROM ".$this->table;

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function readLazy(){
        
        $sql = "SELECT 
                    equ_fal.*,
                    equ.tag AS tag_equipamento,
                    equ.equipamento,
                    fal.tag AS tag_falha,
                    fal.falha
                FROM
                    ".$this->table." equ_fal
                        INNER JOIN
                    equipamentos equ ON equ_fal.id_equipamento = equ.id
                        INNER JOIN
                    falhas fal ON equ_fal.id_falha = fal.id";

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function readFalhasEquipamento($data){
        
        
        $this->populate($data);
        
        $sql = "SELECT 
                    fal.id,fal.tag, fal.falha
                FROM
                    tecumsehalarmes63112.equipamento_falhas equ_fal
                    INNER JOIN falhas fal
                        on equ_fal.id_falha = fal.id
                WHERE
                    id_equipamento = :id_equipamento";

 
                $query = $this->conn->prepare($sql);

                $query->bindValue(':id_equipamento', $this->id_equipamento, PDO::PARAM_STR);

                $result = Database::executa($query);   

                $this->log->setInfo("Buscou ($this->model readFalhasEquipamento) o registro $this->id_equipamento");


        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function getId($data){
        
        $this->populate($data);

        $sql = "SELECT * FROM ".$this->table." 
        WHERE `id_equipamento` = :id_equipamento AND `id_falha` = :id_falha;";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':id_equipamento', $this->id_equipamento_o, PDO::PARAM_STR);
        $query->bindValue(':id_falha', $this->id_falha_o, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model getId) o registro $this->id");

        return $result;
    }

    function create($data){
        
        $this->populate($data);
        
        $sql = "INSERT INTO ".$this->table." 
                    (`id_equipamento`,
                    `id_falha`,
                    `observacao`,
                    `criado`)
                    VALUES
                    (:id_equipamento,
                    :id_falha,
                    :observacao,
                    curtime())";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id_equipamento', $this->id_equipamento, PDO::PARAM_STR);
        $query->bindValue(':id_falha', $this->id_falha, PDO::PARAM_STR);
        $query->bindValue(':observacao', $this->observacao, PDO::PARAM_STR);
        
        $result = Database::executa($query); 
          
        $this->log->setInfo("Criou ($this->model create) o registro ". $this->conn->lastInsertId());

        return $result;
    }

    function update($data){

        $this->populate($data);

        $sql = "UPDATE ".$this->table." 
                SET
                `id_equipamento` = :id_equipamento,
                `id_falha` = :id_falha,
                `observacao` = :observacao,
                `editado` = curtime()
                WHERE `id_equipamento` = :id_equipamento_o AND `id_falha` = :id_falha_o;";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':id_equipamento_o', $this->id_equipamento_o, PDO::PARAM_STR);
        $query->bindValue(':id_falha_o', $this->id_falha_o, PDO::PARAM_STR);
        $query->bindValue(':id_equipamento', $this->id_equipamento, PDO::PARAM_STR);        
        $query->bindValue(':id_falha', $this->id_falha, PDO::PARAM_STR);  
        $query->bindValue(':observacao', $this->observacao, PDO::PARAM_STR);  
      
        $result = Database::executa($query);   

        $this->log->setInfo("Atualizaou ($this->model update) o registro $this->id");

        return $result;
    }

    function delete($data){

        $this->populate($data);

        $sql = "DELETE FROM ".$this->table." 
        WHERE `id_equipamento` = :id_equipamento_o AND `id_falha` = :id_falha_o;";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':id_equipamento_o', $this->id_equipamento_o, PDO::PARAM_STR);
        $query->bindValue(':id_falha_o', $this->id_falha_o, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Removeu ($this->model delete) o registro $this->id");
        
        return $result;
    }


}

