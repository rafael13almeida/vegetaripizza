<?php
session_start();

$user = "root";
$pass = "";
$db = "vegetaripizza";
$host = "localhost";

try {

    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);

} catch(PDOException $e) {

    print "Erro: " . $e->getMessage() . "<br/>";
    die(); 
}
?>