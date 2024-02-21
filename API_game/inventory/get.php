<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");

try{
    $charID = $_GET['characterID'];

    //get data
    $query = "SELECT * FROM inventories where characterID = '$charID'";
    $result = $dbConn->query($query);
    $inven = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "status" => true,
            "message" => "get inventory",
            "data" => $inven
        )
    );

}catch (Exception $e){
    echo json_encode(
        array(
            "status" => false,
            "message" => $e->getMessage()
        )
        );
}
?>