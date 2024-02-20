<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../database/conection.php");

try{
    $userId = $_GET['userId'];

    //get data
    $query = "SELECT id, name, price, image, quantity, size, ice, ice_quant, userId FROM cart where userId = '$userId'";
    $result = $dbConn->query($query);
    $cart = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "status" => true,
            "message" => "Lay cart thanh cong",
            "data" => $cart
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