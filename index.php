<?php
use App\Controller\LoginController;

session_start();
require_once "./vendor/autoload.php";

$login = new LoginController();
$logado = $login->verificarLogado();

$dadosLogado = $logado['result_array'][0];

$modulos=[
    "EquipamentoController"=>[
        'tela'=>[
            [
                'nome'=>"Equipamentos",
                'caminho'=>"/front/equipamento.php",
            ],
            [
                'nome'=>"Procedimentos",
                'caminho'=>"/front/procedimento.php",
            ]
        ],
        'permissao' => 1,
        'funcoes' => [
                'create'=>1,
                'read'=>0,
                'getId'=>1,
                'update'=>1,
                'delete'=>1
            ]
    ],
    "EquipamentoFalhaController"=>[
        'tela'=>[
            [
                'nome'=>"Falhas do Equipamento",
                'caminho'=>"/front/equipamento_falha.php",
            ]
        ],
        'permissao' => 1,
        'funcoes' => [
                'create'=>1,
                'read'=>1,
                'getId'=>1,
                'update'=>1,
                'delete'=>1,
                'readFalhasEquipamento'=>0
            ]
    ],
    "FalhaController"=>[
        'tela'=>[
            [
                'nome'=>"Falhas",
                'caminho'=>"/front/falha.php",
            ]
        ],
        'permissao' => 1,
        'funcoes' => [
                'create'=>1,
                'read'=>1,
                'getId'=>1,
                'update'=>1,
                'delete'=>1
            ]
    ],
    "FalhaProcedimentoController"=>[
        'tela'=>[
            [
                'nome'=>"Procedimento Falhas",
                'caminho'=>"/front/falha_procedimento.php",
            ],
            [
                'nome'=>"Relatório Procedimentos Falhas",
                'caminho'=>"/front/rel_procediments_falha.php",
            ]
        ],
        'permissao' => 1,
        'funcoes' => [
                'create'=>1,
                'read'=>1,
                'getId'=>1,
                'update'=>1,
                'delete'=>1,
                'procedimentosFalhas'=>1,
                'procedimentoFalhaEquipamento'=>0,
                'readLazy'=>1,
            ]
    ],
    "UsuarioController"=>[
        'tela'=>[
            [
                'nome'=>"Usuários",
                'caminho'=>"/front/usuario.php",
            ]
        ],
        'permissao' => 1,
        'funcoes' => [
                'create'=>1,
                'read'=>1,
                'getId'=>1,
                'update'=>1,
                'delete'=>1
            ]
    ],
];


$request = $_REQUEST;
$request['files'] = $_FILES;

$class = $request['class'];
$method = $request['method'];

if(!$logado['count']){
    $class= "LoginController";
    $method= "getLogin";
}


if($modulos[$class]['permissao'] > $dadosLogado['permissao'] && $modulos[$class]['funcoes'][$method] > $dadosLogado['permissao']){
    die("Sem permissão");
}

$namespace = "App\Controller\\".$class;
$params = $request;
$class = new $namespace;

$result = call_user_func_array(array($class, $method), array($params));

$result['user'] = $_SESSION['email'];

echo json_encode($result);

