<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../database/conection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $total = $data->total;
    $userId = $data->userId;
    // add 
    $query = "INSERT INTO histories SET name = '$name', total = '$total', userId='$userId' ";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();

    echo json_encode(
        array(
            "status" => true,
            "message" => "add to cart"
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