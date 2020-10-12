<?php
namespace controller;

//define de todos os dados referente à conexão com o banco
define('HOST', '191.252.185.132');
define('USER', 'sandereto');
define('PASSWORD', 'Sander@2017');
define('DATABASE', 'toAqui');
define('PORT', '3306');
define('CHARSET', 'utf8mb4');

$mysqli = new \mysqli(HOST, USER, PASSWORD, DATABASE, PORT);
if($mysqli->connect_error) {
    exit('Erro ao conectar ao banco de dados');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli->set_charset(CHARSET);

	

	/*//faz a conexão com o banco de dados
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE, PORT) or die(mysqli_error('SEM CONEXÃO'));
	
	mysqli_set_charset($link, CHARSET) or die(mysqli_error($link));*/

?>
