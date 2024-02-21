<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $amount = $data->amount;
    $userID = $data->userID;
    
    // add 
    $query = "INSERT INTO transactions SET amount = '$amount', userID = '$userID'";
    // $wery = "UPDATE users SET balance = '$amount' WHERE userID = '$userID' ";

    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    // $stmt = $dbConn->prepare($wery);
    // $stmt->execute();
    echo json_encode(
        array(
            "status" => true,
            "message" => "add trans"
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