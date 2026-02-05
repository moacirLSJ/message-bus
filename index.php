<?php
require_once __DIR__ . '/vendor/autoload.php';

use Moacir\Barramento\MessageBus;
use Moacir\Barramento\NameChanger;
use Moacir\Barramento\Validate;
use Moacir\Barramento\Aluno;
use Moacir\Barramento\Name;
print_r($_REQUEST);
$controllers = [
    'updateName' => [
        'class' => NameChanger::class,
        'method' => 'doChange',
    ],
    // 'updateEmail' => [
    //     'update' => EmailChanger::class,
    // ],
    // 'updateCpf' => [
    //     'update' => CpfChanger::class,
    // ],
];
$aluno = new Aluno('1', new Name('Moacir'), 'moacir@email.br', '12345678901');
$aluno->subscribe();
Validate::validate($_REQUEST, $controllers);
$controller = $_REQUEST['controller'];
$action = $_REQUEST['action'];
$messageBus = MessageBus::getInstance();
$object = new $controllers[$controller]['class'];
$object->{$controllers[$controller]['method']}($_REQUEST['data']);
$messageBus->dispatch();
echo '<pre>';
var_dump($aluno);
echo '</pre>';