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
$nome = $data->nome;
$validade = $data->validade;
$preco = $data->preco;
$promocao = $data->promocao;
$foto = $data->foto;

$query = "INSERT INTO produtos (nome, validade, preco, promocao, foto)
VALUES ('$nome', '$validade', '$preco', '$promocao', '$foto')";

if ($conn->query($query)) {
    // define código de resposta - 201 created
    http_response_code(201);

    $json = array();
    $produtos = array(
        'msg' => 'Produto criado com sucesso.'
    );
    $json[] = $produtos;

    echo json_encode($json, JSON_PRETTY_PRINT);
} else {
    // define código de resposta - 503 service unavailable
    http_response_code(503);
    $json = array();
    $produtos = array(
        'msg' => 'Erro - Não foi possível criar um produto.'
    );
    $json[] = $produtos;
}
