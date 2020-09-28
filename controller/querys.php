<?php
require_once '../controller/mysqli_connect.php';

function query_materias_aluno($id){
        $consulta = "SELECT A.NOME AS NOMEALUNO, C.NOME AS NOMECURSO, D.NOME AS NOMEDISCIPLINA, T.DIA AS DIASEMANA, TN.NOME AS TURNO, T.ID AS IDCURSO FROM aluno as A INNER JOIN curso AS C ON A.idcurso = C.id
        INNER JOIN disciplina AS D ON C.id = D.idcurso
        INNER JOIN turma AS T ON D.id = T.iddisciplina
        INNER JOIN turno AS TN ON T.idturno = TN.id
        WHERE A.id = '{$id}' ";

    return $consulta;
}