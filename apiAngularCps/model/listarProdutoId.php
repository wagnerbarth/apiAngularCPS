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

$id = $id = isset($_GET['id']) ? $_GET['id'] : die();

$sql = "SELECT * FROM produtos WHERE id='$id'";

$result = $conn->query($sql);

// $json = array();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $produto = array(
            'id' => utf8_encode($row['id']),
            'nome' => utf8_encode($row['nome']),
            'validade' => utf8_encode($row['validade']),
            'preco' => utf8_encode($row['preco']),
            'promocao' => utf8_encode($row['promocao']),
            'foto' => utf8_encode($row['foto']),
        );
        // $json[] = $produtos;
    }
    // converte o array em Json
    http_response_code(200);
    echo json_encode($produto, JSON_PRETTY_PRINT);
} else {
    //echo "0 resultados";
    http_response_code(503);

    $json = array();
    $produtos = array(
        'msg' => 'Alerta - Não foi possível listar produtos.'
    );
    $json[] = $produtos;
}
