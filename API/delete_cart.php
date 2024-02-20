<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../database/conection.php");

try {
    $userId = $_GET['userId'];
    // delete
    $query = "DELETE FROM cart WHERE userId = '$userId' ";
    $stmt = $dbConn->query($query);
   
    echo json_encode(
        array(
            "status" => true,
            "message" => "xoa thanh cong"
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