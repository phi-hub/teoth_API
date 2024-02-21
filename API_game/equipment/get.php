<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");

try{
   
    //get data
    $query = "SELECT * FROM equipments";
    $result = $dbConn->query($query);
    $equip = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "status" => true,
            "message" => "get equipment",
            "data" => $equip
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