<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $price = $data->price;
    $characterID = $data->characterID;
    $equipmentID = $data->equipmentID;

    // add 
    $query = "INSERT INTO inventories SET price = '$price', createAt = '$createAt', characterID = '$characterID', 
        equipmentID = '$equipmentID'";


    $stmt = $dbConn->prepare($query);
    $stmt->execute();

    echo json_encode(
        array(
            "status" => true,
            "message" => "add char"
        )
    );
    

}
catch (Exception $e){
    echo json_encode(
        array(
            "status" => false,
            "message" => $e->getMessage()
        )
        );
}
?>