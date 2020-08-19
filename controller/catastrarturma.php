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
    $stmt = $mysqli->prepare('SELECT id FROM curso WHERE nome=?');
    $stmt->bind_param('s', $ajax['curso']);
    $stmt->execute();

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

        $id = $mysqli->inserted_id;
    }

    $stmt->close();
    $stmt = $mysqli->prepare('INSERT IGNORE INTO disciplina (nome, periodo, idcurso) VALUES (?, ?, ?)');
    $stmt->bind_param('sii', $ajax['disciplina'], 0, $id);
    $stmt->execute();

    if ($stmt->affected_rows) {
        $id = $mysqli->inserted_id;
    }
    else {
        $stmt = $mysqli->prepare('SELECT id FROM disciplina WHERE nome=? AND idcurso=?');
        $stmt->bind_param('si', $ajax['disciplina'], $id);
        $stmt->execute();

        $stmt->bind_result($id);
        $stmt->fetch();
    }

    session_start();

    $stmt->close();
    $stmt = $mysqli->prepare('INSERT INTO turma (dia, idperiodoLetivo, idturno, iddisdiplina, idprofessor) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('iiiii', $ajax['dia'], 0, $ajax['turno'], $id, $_SESSION['user']['cpf']);
    $stmt->execute();

    session_write_close();
    $stmt->close();
}

?>
