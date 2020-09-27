<?php

namespace App\DAO;
/**
 * INCLUSAO DA CLASSE QUE SEGURA AS INFORMAÇOES PARA CONEXÃO COM O BANCO
 */
require_once 'InfoDB.php';

use PDO;

/**
 * INICIO DA CLASSE CHAMADA DATABASE.
 * A CLASSE FAZ EXTENSAO DA INFODB PARA ACESSAR AS INFORMAÇOES REFERENTES À CONEXAO
 * COM O BANCO DE DADOS.
 */
class Database extends InfoDB
{

    /**
     * VARIAVEL RESPONSAVEL POR SEGURAR O OBJETO DA CONEXAO COM O BANCO DE DADOS
     * DEFINIDA COMO STATICA PARA SEJA ACESSADA DE QUALQUER LUGAR DO SOFTWARE
     */
    private static $con = null;
    private $host = "DESKTOP-BLSE21H\SQLEXPRESS";
    private $database = "tecumsehalarmes63112";
    private $user = "sa";
    private $password = "Tecumseh@2020";
    private $driver = "sqlsrv";

    function getHost(){
        return $this->host;
    }
    
    function getDatabase(){
        return $this->database;
    }

    function getUser(){
        return $this->user;
    }
    
    function getPassword(){
        return $this->password;
    }   

    function getDriver(){
        return $this->driver;
    }

    /**
     * METODO ACESSOR ALTERADO PARA VERIFICAR SE JA EXISTE UMA INSTANCIA DO
     * OBJETO DE CONEXAO.
     */
    static function getConnect()
    {
        /**
         * VERIFICA SE A VARIAVEL ESTATICA QUE SEGURA A CONEXAO ESTA NULA, CASO
         * NAO SEJA NULA, ISSO EQUIVALE À UMA VARIAVEL QUE JA POSSUI UM OBJETO COM
         * CONEXAO COM O BANCO
         */
        if (self::$con == null) {
            /**
             * FAZ INSTANCIA DA CLASSE DATABASE
             */
            $data = new Database();
            /**
             * CHAMA O METODO QUE ATRIBUI À VARIAVEL ESTATICA UM OBJETO DE
             * CONEXAO COM O BANCO
             */
            $data->connect();
        }

        /**
         * RETORNA O OBJETO DE CONEXAO COM O BANCO
         */
        
        return self::$con;
    }

    /**
     * METODO PARA CRIAR O OBJETO DE CONEXAO COM O BANCO E ATRIBUI-LO NA
     * VARIAVEL ESTATICA RESPPONSAVEL PELO MESMO
     */
    private function connect()
    {
        
        $pdoConfig  = $this->driver . ":". "Server=" . $this->host . ";";
       $pdoConfig .= "Database=".$this->database.";";

        try {
            
            if(!isset(self::$con)){
                
                self::$con =  new PDO($pdoConfig, $this->user, $this->password);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            
         } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            
            throw new Exception($mensagem);
         }
    }

    /**
     * METODO PARA CRIAR O OBJETO DE CONEXAO COM O BANCO E ATRIBUI-LO NA
     * VARIAVEL ESTATICA RESPPONSAVEL PELO MESMO
     */
    static function init_transection($dbh)
    {

        $dbh->beginTransaction();

    }

//CENTRALIZANDO A EXECUÇÃO DE QUERY TODA QUERY DO SISTEMA DEVE SER ENVIADA PARA ESSA FUNÇÃO

    static function executa($sql)
    {
        try {

            $arrayRetorno['status'] = true;
            $arrayRetorno['result'] = $sql->execute();
            $arrayRetorno['result_array'] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $arrayRetorno['count'] = $sql->rowCount();
            $arrayRetorno['MSN'] = "";
            
            
        } catch (\PDOException $Exception) {

            $arrayRetorno['status'] = false;
            $arrayRetorno['MSN'] = $Exception;
            
        }

        return $arrayRetorno;

    }

    //CENTRALIZANDO A EXECUÇÃO DE QUERY TODA QUERY DO SISTEMA DEVE SER ENVIADA PARA ESSA FUNÇÃO

    
    static function comitar($dbh)
    {

        $dbh->commit();

    }

    static function rollbackar($dbh)
    {

        $dbh->rollBack();

    }

}
?>
