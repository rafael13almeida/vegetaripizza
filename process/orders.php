<?php
include_once("conexao.php");

$method = $_SERVER["REQUEST_METHOD"];


if ($method === "GET") {

$pedidoQuery = $conexao->query("SELECT * FROM pedidos;");

$pedidos = $pedidoQuery->fetchAll();

$pizzas = [];

foreach ($pedidos as $pedido) {
    $pizza = [];

    $pizza["id"] = $pedido["pizza_id"];

    $pizzaQuery = $conexao->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");
    $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);

    $pizzaQuery->execute();

    $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

    $bordaQuery = $conexao->prepare("SELECT * FROM bordas WHERE id = :borda_id");
    $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);
    
    $bordaQuery->execute();
    
    $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);
    
    $pizza["borda"] = $borda["tipo"];

    $massaQuery = $conexao->prepare("SELECT * FROM massas WHERE id = :massa_id");
    $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);

    $massaQuery->execute();

    $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);

    $pizza["massa"] = $massa["tipo"];

    $saboresQuery = $conexao->prepare("SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id");
    $saboresQuery->bindParam(":pizza_id", $pizza["id"]);

    $saboresQuery->execute();

    $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

    $saboresDaPizza = [];

    $saborQuery = $conexao->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

    foreach ($sabores as $sabor) {

        $saborQuery->bindParam(":sabor_id", $sabor["sabor_id"]);
        $saborQuery->execute();

        $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);

        array_push($saboresDaPizza, $saborPizza["nome"]);
    }

    $pizza["sabores"] = $saboresDaPizza;

    $pizza["status"] = $pedido["status_id"];

    array_push($pizzas, $pizza);
 
}

$statusQuery = $conexao->query("SELECT * FROM status;");

$status = $statusQuery->fetchAll();


} elseif ($method === "POST") {

    $type = $_POST["type"];

    if ($type === "delete") {

        $pizzaId = $_POST["id"];

        $deleteQuery = $conexao->prepare("DELETE FROM pedidos WHERE pizza_id = :pizza_id;");
        $deleteQuery->bindParam(":pizza_id", $pizzaId, PDO::PARAM_INT);

        $deleteQuery->execute();

        $_SESSION["msg"] = "Pedido removido !";
        $_SESSION["status"] = "success";
    }

    header("Location: ../dashboard.php");

}


?>