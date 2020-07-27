<?php
namespace controller;
require 'fromajax.php';
require_once 'mysqli_connect.php';

header('Content-Type: application/json');

class Validate {
    static function Cpf(string &$cpf) {
        $cpf = str_replace('-', '', $cpf);
        $cpf = str_replace('.', '', $cpf);
        $cpf = trim(preg_replace("/\s/", '', $cpf));

        if (preg_match("/^[0-9]{11}$/", $cpf)) {
            $first_dig = $second_dig = 0;
            $streak = $cpf[0];

            for ($i=0; $i < 9; $i++) {
                $first_dig += intval($cpf[$i]) * (10 - $i);
                $second_dig += intval($cpf[$i]) * (11 - $i);

                // Verifica por CPF com todos os numeros repetidos
                if ($cpf[$i] == $streak) {
                    $streak = $cpf[$i];
                }
                else $streak = false;
            }

            // Se todods os numeros forem iguais
            if ($streak !== false && $streak == $cpf[9] && $streak == $cpf[10]) {
                return false;
            }

            // Valida o primeiro digito verificador
            $first_dig = ($first_dig * 10) % 11;
            if ($first_dig == 10) $first_dig = 0;
            if ($first_dig != intval($cpf[9])) {
                return false;
            }

            // Valida o segundo digito verificador
            $second_dig += $first_dig * 2;
            $second_dig = ($second_dig * 10) % 11;
            if ($second_dig == 10) $second_dig = 0;
            if ($second_dig != intval($cpf[10])) {
                return false;
            }

            return true;
        }
        else return false;
    }

    static $namePat = "/^[A-Z]{3,}( [A-Z]+)?$/";
    static $emailPat = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    static $senhaPat = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!-\/:-@\[-`{-~])(?=.{8,})/";

    public static function Login(array $ajax) {
        return preg_match(Validate::$namePat, strtoupper(Validate::Trim($ajax['nome']))) &&
               preg_match(Validate::$namePat, strtoupper(Validate::Trim($ajax['sobrenome']))) &&
               preg_match(Validate::$emailPat, Validate::Trim($ajax['email'])) &&
               Validate::CPF($ajax['cpf']) &&
               preg_match(Validate::$senhaPat, trim($ajax['senha']))  &&
               ($ajax['tipo'] == "0" || $ajax['tipo'] == "1");
    }

    public static function Trim(string &$str) {
        $str = trim($str);
        return $str;
    }
}

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
            $statement = "INSERT IGNORE INTO professor (nome, sobreNome, cpf, senha, pin, matricula) VALUES (?, ?, ?, ?, ?, ?)";
            $matricula = $ajax['codProfessor'];
            break;
        case '1':
            $statement = "INSERT IGNORE INTO aluno (nome, sobreNome, cpf, senha, pin, ra) VALUES (?, ?, ?, ?, ?, ?)";
            $matricula = $ajax['ra'];
            break;
    }

    $pin = rand();
    $pwd = password_hash($ajax['senha'] . $pin, PASSWORD_DEFAULT);

    $statement = $mysqli->prepare($statement);
    $statement->bind_param('ssssis', $ajax['nome'], $ajax['sobrenome'], $ajax['cpf'], $pwd, $pin, $matricula);
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
