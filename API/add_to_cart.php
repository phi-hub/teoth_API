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
    $price = $data->price;
    $image = $data->image;
    $quantity = $data->quantity;
    $size = $data->size;
    $ice = $data->ice;
    $ice_quant = $data->ice_quant;
    $userId = $data->userId;
    

    // add 
    $query = "INSERT INTO cart SET name = '$name', price = '$price', image = '$image', quantity = '$quantity', size = '$size', ice = '$ice', ice_quant = '$ice_quant',  userId='$userId' ";
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