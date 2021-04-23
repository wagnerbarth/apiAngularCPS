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
$data = json_decode(file_get_contents("php://input"));


// define as propriedades
$id = $data->id;
$nome = $data->nome;
$validade = $data->validade;
$preco = $data->preco;
$promocao = $data->promocao;
$foto = $data->foto;

$query = "UPDATE produtos SET nome='$nome', validade='$validade', preco='$preco', promocao='$promocao', foto='$foto'
    WHERE id='$id'";

if ($conn->query($query)) {
    // define código de resposta - 200 created
    http_response_code(200);

    $produto = array(
        'id' => utf8_encode($id),
        'nome' => utf8_encode($nome),
        'validade' => utf8_encode($validade),
        'preco' => utf8_encode($preco),
        'promocao' => utf8_encode($promocao),
        'foto' => utf8_encode($foto),
    );
    echo json_encode($produto, JSON_PRETTY_PRINT);
} else {
    // define código de resposta - 503 service unavailable
    http_response_code(503);

    $json = array();
    $produtos = array(
        'msg' => 'Erro - Produto não pode ser alterado.'
    );
    $json[] = $produtos;
}
