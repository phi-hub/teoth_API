<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("/PHP/database/conection.php");

try {
    $inventoryID = $_GET['inventoryID'];
    // delete
    $query = "DELETE FROM inventories WHERE inventoryID = '$inventoryID' ";
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