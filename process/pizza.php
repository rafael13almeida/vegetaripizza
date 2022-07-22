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

    echo "a";

}