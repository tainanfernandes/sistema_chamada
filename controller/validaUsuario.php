<?php
//namespace controller;
include('mysqli_connect.php');
require 'fromajax.php';


//verificação de usuário e senha estão vazios
if(empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: ../login.html');    
    exit();
}

$login = mysqli_real_escape_string($mysqli, $_POST['email']);
$senha = mysqli_real_escape_string($mysqli, $_POST['senha']);

//query que busca os dados na base de dados
$query = "SELECT * FROM aluno WHERE email = '{$login}'";


//envia e armazena o resuldado da conexão da query
$result = mysqli_query($mysqli, $query);
$dados = mysqli_fetch_array($result);
$row = mysqli_num_rows($result);

//compara se o pin+senha gerado pelo hash é o mesmo.
$pin = $dados['pin'];
$senha = $senha.$pin;
if(password_verify($senha, $dados['senha'])){    
        session_start();
           $_SESSION['user'] = [
                'id'        => $dados['id'],
                'nome'      => $dados['nome'],
                'sobrenome' => $dados['sobreNome'],
                'ra'        => $dados['ra'],
                'cpf'       => $dados['cpf'],
                'pin'       => $dados['pin'],
                'email'     => $dados['email'],
                'LOGGED'    => TRUE
            ];
            echo $_POST['email'];
            echo $_POST['senha'];
            echo $_SESSION['user']['nome'];
        header('Location: ../aluno/principalaluno.php');

    }else{
        echo '{"status":403,"msg":"Campos duplicados"}';
        return false;
        echo "<script>alert('Essa conta não possui cadastro');";
        echo "javascript:window.location = '../login.html';</script>";
    }

?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

