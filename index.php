<?php
use App\Controller\LoginController;

session_start();
require_once "./vendor/autoload.php";

$login = new LoginController();
$logado = $login->verificarLogado();
// $base_acessos = "/63112-TECUMSEH-ALARMES";
$base_acessos = "";
$dadosLogado = $logado['result_array'][0];

$modulos=[
    "UsuarioController"=>[
        'tela'=>[
            [
                'nome'=>"Usuários",
                'caminho'=>"$base_acessos/front/usuario.php",
                'permissao'=>1
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
    "EquipamentoController"=>[
        'tela'=>[
            [
                'nome'=>"Equipamentos",
                'caminho'=>"$base_acessos/front/equipamento.php",
                'permissao'=>1
            ]
        ],
        'permissao' => 0,
        'funcoes' => [
                'create'=>1,
                'read'=>0,
                'getId'=>1,
                'update'=>1,
                'delete'=>1
            ]
    ],
    "FalhaController"=>[
        'tela'=>[
            [
                'nome'=>"Falhas",
                'caminho'=>"$base_acessos/front/falha.php",
                'permissao'=>1
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
    "EquipamentoFalhaController"=>[
        'tela'=>[
            [
                'nome'=>"Falhas do Equipamento",
                'caminho'=>"$base_acessos/front/equipamento_falha.php",
                'permissao'=>1
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
    "FalhaProcedimentoController"=>[
        'tela'=>[
            [
                'nome'=>"Procedimento Falhas",
                'caminho'=>"$base_acessos/front/falha_procedimento.php",
                'permissao'=>1
            ],
            [
                'nome'=>"Procedimentos",
                'caminho'=>"$base_acessos/front/procedimento.php",
                'permissao'=>0
            ],
            [
                'nome'=>"Relatório Procedimentos Falhas",
                'caminho'=>"$base_acessos/front/rel_procediments_falha.php",
                'permissao'=>1
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
    $result['permissoes'] = $modulos;
    $result['atenção'] = "Sem permissão";
    echo json_encode($result);
    die;
}

$namespace = "App\Controller\\".$class;
$params = $request;
$class = new $namespace;

$result = call_user_func_array(array($class, $method), array($params));

$result['permissaoLogado'] = $dadosLogado['permissao'];
$result['user'] = $_SESSION['email'];
$result['permissoes'] = $modulos;
echo json_encode($result);

