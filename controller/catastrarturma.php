<?php
namespace controller;
require_once 'fromajax.php';
require_once 'validate.php';
require_once 'mysqli_connect.php';

header('Content-Type: application/json');

$ajax = FromAjax::Post(
    'curso',
    'disciplina',
    'dia',
    'turno',
    'descricao');

if (
    $ajax &&
    in_array($ajax['dia'], ["seg", "ter", "qua", "qui", "sex"]) &&
    in_array($ajax['turno'], ["1", "2"])
) {
    // Cadastro
}

?>
