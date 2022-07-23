<?php
include_once("conexao.php");

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {

    $bordasQuery = $conexao->query("SELECT * FROM bordas;");
    $bordas = $bordasQuery->fetchAll();

    $massasQuery = $conexao->query("SELECT * FROM massas;");
    $massas = $massasQuery->fetchAll();

    $saboresQuery = $conexao->query("SELECT * FROM sabores;");
    $sabores = $saboresQuery->fetchAll();

} else if ($method === "POST") {

    $data = $_POST;

    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];

    if (count($sabores) > 3) {

        $_SESSION["msg"] = "Selecione no máximo 3 sabores !";
        $_SESSION["status"] = "warning";

    } else {

        echo "Sucess";
        exit;

    }

    header("Location: ..");

}