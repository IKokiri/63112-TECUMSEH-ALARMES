<?php

namespace App\Model;

use App\DAO\Database;
use App\Core\Model;
use PDO;


class FalhaProcedimentoModel extends Model{

    private $table = "`tecumsehalarmes63112`.`falha_procedimentos`";
    private $model = "FalhaProcedimentoModel";

    function read(){
        
        $sql = "SELECT * FROM ".$this->table;

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function procedimentoFalhaEquipamento($data){
        
        $this->populate($data);
        
        $sql = "SELECT 
                    fal_pro.ordem,
                    fal_pro.procedimento,
                    equ.tag AS tag_equipamento,
                    equ.equipamento,
                    equ_fal.observacao,
                    fal.tag AS tag_falha,
                    fal.falha
                FROM
                    ".$this->table." fal_pro
                        INNER JOIN
                    equipamento_falhas equ_fal ON fal_pro.id_falha = equ_fal.id_falha
                        INNER JOIN
                    equipamentos equ ON equ_fal.id_equipamento = equ.id
                        INNER JOIN
                    falhas fal ON equ_fal.id_falha = fal.id
                WHERE
                    fal_pro.id_falha = :id_falha
                        AND equ_fal.id_equipamento = :id_equipamento
                ORDER BY fal_pro.ordem ASC";

                $query = $this->conn->prepare($sql);
        
                $query->bindValue(':id_falha', $this->id_falha, PDO::PARAM_STR);
                $query->bindValue(':id_equipamento', $this->id_equipamento, PDO::PARAM_STR);
                
                $result = Database::executa($query); 

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }
    
    function readLazy(){
        
        $sql = "SELECT fal_pro.*,fal.tag,fal.falha FROM ".$this->table." fal_pro
                    INNER JOIN falhas fal
                        on fal_pro.id_falha = fal.id";

        $query = $this->conn->prepare($sql);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model read) os registros");

        return $result;

    }

    function getId($data){
        
        $this->populate($data);

        $sql = "SELECT * FROM ".$this->table." 
        WHERE `id` = :id;";

        $query = $this->conn->prepare($sql);

        $query->bindValue(':id', $this->id, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Buscou ($this->model getId) o registro $this->id");

        return $result;
    }

    function create($data){
        
        $this->populate($data);
        
        $sql = "INSERT INTO ".$this->table." 
                    (`id_falha`,
                    `ordem`,
                    `procedimento`,
                    `criado`)
                    VALUES
                    (:id_falha,
                    :ordem,
                    :procedimento,
                    curtime())";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id_falha', $this->id_falha, PDO::PARAM_STR);
        $query->bindValue(':ordem', $this->ordem, PDO::PARAM_STR);
        $query->bindValue(':procedimento', $this->procedimento, PDO::PARAM_STR);
        
        $result = Database::executa($query); 
          
        $this->log->setInfo("Criou ($this->model create) o registro ". $this->conn->lastInsertId());

        return $result;
    }

    function update($data){

        $this->populate($data);

        $sql = "UPDATE ".$this->table." 
                SET
                `id_falha` = :id_falha,
                `ordem` = :ordem,
                `procedimento` = :procedimento,
                `editado` = curtime()
                WHERE `id` = :id;";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id', $this->id, PDO::PARAM_STR);
        $query->bindValue(':id_falha', $this->id_falha, PDO::PARAM_STR);        
        $query->bindValue(':ordem', $this->ordem, PDO::PARAM_STR);        
        $query->bindValue(':procedimento', $this->procedimento, PDO::PARAM_STR);  
      
        $result = Database::executa($query);   

        $this->log->setInfo("Atualizaou ($this->model update) o registro $this->id");

        return $result;
    }

    function delete($data){

        $this->populate($data);

        $sql = "DELETE FROM ".$this->table." 
                    WHERE `id` = :id;";

        $query = $this->conn->prepare($sql);
        
        $query->bindValue(':id', $this->id, PDO::PARAM_STR);

        $result = Database::executa($query);   

        $this->log->setInfo("Removeu ($this->model delete) o registro $this->id");
        
        return $result;
    }

}

