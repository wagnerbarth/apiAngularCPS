<?php
//this will show error if any error happens
error_reporting(E_ALL);
ini_set('display_errors', 1);

//enable cors
header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Credentials: true');
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//header("Access-Control-Allow-Headers: Content-Type");

include "connect.php";

// recebe dados via POST - Body
// $data = json_decode(file_get_contents("php://input"));


// define as propriedades
/*$id = $data->id;
$nome = $data->nome;
$validade = $data->validade;
$preco = $data->preco;
$promocao = $data->promocao;
$foto = $data->foto;*/

$id = $id = isset($_GET['id']) ? $_GET['id'] : die();

$query = "UPDATE produtos SET nome='$nome', validade='$validade', preco='$preco', promocao='$promocao', foto='$foto'
    WHERE id='$id'";

if ($conn->query($query)) {
    // define código de resposta - 200 created
    http_response_code(200);

    $json = array();
    $produtos = array(
        'msg' => 'Produto alterado com sucesso.'
    );
    $json[] = $produtos;
} else {
    // define código de resposta - 503 service unavailable
    http_response_code(503);

    $json = array();
    $produtos = array(
        'msg' => 'Erro - Produto não pode ser alterado.'
    );
    $json[] = $produtos;
}
