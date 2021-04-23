<?php
//this will show error if any error happens
error_reporting(E_ALL);
ini_set('display_errors', 1);

//enable cors
header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Credentials: true');
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//header("Access-Control-Allow-Headers: Content-Type");

// inclui arquivo de configuração 
include '../config/config.php';

// variável $conn recebe conexão e se torna um objeto
$conn = new mysqli($host, $user, $password, $database);

// objeto $conn configura caracteres para padrão UTF-8
$conn->set_charset("utf8");

// verifica se a conexão foi estabelecida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
if ($log){
    echo "Conexão bem sucedida <br />";
}
