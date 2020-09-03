<?php
namespace controller;

$mysqli = new \mysqli("191.252.185.132", "sandereto", "Sander@2017", 'toAqui', '3306');
if ($mysqli->connect_error) {
    exit('Erro ao conectar ao banco de dados');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

?>
