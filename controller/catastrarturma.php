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
    $aux = 0; // TEMPORARIO //TODO

    $stmt = $mysqli->prepare('SELECT id FROM curso WHERE nome=?');
    $stmt->bind_param('s', $ajax['curso']);
    $stmt->execute();
    $stmt->store_result();

    $id = NULL;

    if ($stmt->num_rows) {
        $stmt->bind_result($id);
        $stmt->fetch();
    }
    else {
        $stmt->close();
        $stmt = $mysqli->prepare('INSERT INTO curso (nome) VALUES (?)');
        $stmt->bind_param('s', $ajax['curso']);
        $stmt->execute();

        $id = $mysqli->insert_id;
    }

    $stmt->close();
    $stmt = $mysqli->prepare('SELECT id FROM disciplina WHERE nome=? AND idcurso=?');
    $stmt->bind_param('si', $ajax['disciplina'], $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows) {
        $stmt->bind_result($id);
        $stmt->fetch();
    }
    else {
        $stmt->close();
        $stmt = $mysqli->prepare('INSERT IGNORE INTO disciplina (nome, periodo, idcurso) VALUES (?, ?, ?)');
        // TODO periodo
        $stmt->bind_param('sii', $ajax['disciplina'], $aux, $id);
        $stmt->execute();

        $id = $mysqli->insert_id;
    }

    $stmt->close();
    $stmt = $mysqli->prepare('SELECT id FROM turma WHERE dia=? AND iddisciplina=? AND idturno=?');
    $stmt->bind_param('sii', $ajax['dia'], $id, $ajax['turno']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows) {
        echo '{"status":403,"msg":"Campos duplicados"}';
    }
    else {
        session_start();

        $stmt->close();
        $stmt = $mysqli->prepare('INSERT INTO turma (dia, idperiodoLetivo, idturno, iddisciplina, idprofessor) VALUES (?, ?, ?, ?, ?)');
        // TODO periodo
        $stmt->bind_param('siiii', $ajax['dia'], $aux, $ajax['turno'], $id, $_SESSION['user']['id']);
        $stmt->execute();

        session_write_close();

        if ($stmt->affected_rows) {
            echo '{"status":201,"msg":"Sucesso"}';
        }
        else echo '{"status":500,"msg":"Erro Desconhecido"}';
    }
    $stmt->close();
}
else echo '{"status":400,"msg":"Parametros Inválidos"}';

?>
