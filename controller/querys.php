<?php
// require_once '../controller/mysqli_connect.php';

function query_materias_aluno($id)
{
    $consulta = "SELECT A.NOME AS NOMEALUNO, C.NOME AS NOMECURSO, D.NOME AS NOMEDISCIPLINA, T.DIA AS DIASEMANA, TN.NOME AS TURNO, T.PIN AS IDCURSO FROM aluno as A INNER JOIN curso AS C ON A.idcurso = C.id
        INNER JOIN disciplina AS D ON C.id = D.idcurso
        INNER JOIN turma AS T ON D.id = T.iddisciplina
        INNER JOIN turno AS TN ON T.idturno = TN.id
        WHERE A.id = '{$id}' ";

    return $consulta;
}

$sqlPrincipalProfAccordion =
    "SELECT di.nome AS NMDISCIPLINA, cs.nome AS NMCURSO, tm.dia AS DIA, tn.nome AS TURNO, tm.pin AS PIN, tm.obsTurma AS OBSERVACAO
       FROM turno tn, turma tm, disciplina di, curso cs
      WHERE tm.idturno = tn.id
        AND tm.iddisciplina = di.id
        AND di.idcurso = cs.id";