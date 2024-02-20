<?php
include_once("./database/conection.php");

$id = $_GET['id'];

$sql ="DELETE FROM products WHERE id = $id";

$result = $dbConn->exec($sql);

header("Location: index.php");

?>