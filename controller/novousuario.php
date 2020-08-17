<?php
namespace controller;
require_once 'fromajax.php';
require_once 'validate.php';
require_once 'mysqli_connect.php';

header('Content-Type: application/json');

$ajax = FromAjax::Post(
    'nome',
    'sobrenome',
    'email',
    'cpf',
    'senha',
    'tipo',
    'ra',
    'codProfessor');

if ($ajax && Validate::Login($ajax)) {
    $statement = false;
    $matricula = false;

    switch ($ajax['tipo']) {
        case '0':
            $statement = "INSERT IGNORE INTO professor (cpf, nome, sobreNome, senha, pin, matricula) VALUES (?, ?, ?, ?, ?, ?)";
            $matricula = $ajax['codProfessor'];
            break;
        case '1':
            $statement = "INSERT IGNORE INTO aluno (cpf, nome, sobreNome, senha, pin, ra) VALUES (?, ?, ?, ?, ?, ?)";
            $matricula = $ajax['ra'];
            break;
    }

    $pin = rand();
    $pwd = password_hash($ajax['senha'] . $pin, PASSWORD_DEFAULT);

    $statement = $mysqli->prepare($statement);
    $statement->bind_param('ssssis', $ajax['cpf'], $ajax['nome'], $ajax['sobrenome'], $pwd, $pin, $matricula);
    $statement->execute();

    if ($statement->affected_rows) {
        echo '{"status":201,"msg":"Sucesso"}';

        session_start();
        $_SESSION['user'] = [
            'nome'      => $ajax['nome'],
            'sobrenome' => $ajax['sobrenome'],
            'cpf'       => $ajax['cpf'],
            'matricula' => $matricula,
            'tipo'      => $ajax['tipo']
        ];
        session_write_close();
    }
    else echo '{"status":403,"msg":"Campos duplicados"}';

    $statement->close();
}
else echo '{"status":400,"msg":"Parametros Inválidos"}';

?>
