<?php
define('DB_HOST'        , "DESKTOP-BLSE21H\SQLEXPRESS");
define('DB_USER'        , "sa");
define('DB_PASSWORD'    , "Tecumseh@2020");
define('DB_NAME'        , "TECUMSEH");
define('DB_DRIVER'      , "sqlsrv");

require_once "Conexao.php";

$Conexao = Conexao::getConnection();
$method = $_REQUEST['method'];

$param['conexao'] = $Conexao;
$param['data_inicio'] = $_REQUEST['data_inicio'];
$param['hora_inicio'] = $_REQUEST['hora_inicio'];
$param['data_fim'] = $_REQUEST['data_fim'];
$param['hora_fim'] = $_REQUEST['hora_fim'];
$param['fundicao'] = $_REQUEST['fundicao'];

call_user_func($method,$param);

function todos($param){
    
    $Conexao = $param['conexao'];

    $arr = array();
    $result = [];
    try{
        
       $q = fazQuery($param);

        $query      = $Conexao->query($q);
        $qry   = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($qry as $data){
            foreach ($data as $key => $value){
                $arr[$key] += $value;
            }
        }

        $result['dados'] = $qry;
        $result['soma'] = $arr;
        
     }catch(Exception $e){
    
        echo $e->getMessage();
        exit;
    
     }
     
 echo json_encode($result);
}
 function fazQuery($param){
     
    $data_inicio = $param['data_inicio'];
    $hora_inicio = $param['hora_inicio'];    
    $data_fim = $param['data_fim'];
    $hora_fim = $param['hora_fim'];    
    $fundicao = $param['fundicao'];

    $where = "";

    
    $di = ($data_inicio)?dataYDM($data_inicio,"-"):"2020-01-01";
    $hi = ($hora_inicio)?$hora_inicio:"00:00:00";
    $df = ($data_fim)?dataYDM($data_fim,"-"):"2120-01-01";
    $hf = ($hora_fim)?$hora_fim:"23:59:00";
    
    $where .= " where DataHoraInicial >= '{$di} {$hi}'";
    $where .= " and DataHoraInicial <= '{$df} {$hf}'";
    

    

    if($fundicao == 1){
        
    return "SELECT 1 as Fundicao,* FROM tbl_Fundicao_01 {$where}";
    }else if($fundicao == 2){
        
        return "SELECT 2 as Fundicao,* FROM tbl_Fundicao_02 {$where}";
    }
    return "SELECT 1 as Fundicao,* FROM tbl_Fundicao_01 {$where} union all SELECT 2 as Fundicao,* FROM tbl_Fundicao_02 {$where}";
 }


 function dataYDM($data,$separador){

    $date = explode($separador,$data);

    $data = $date[0].$separador.$date[2].$separador.$date[1];


    return $data;

 }
?>