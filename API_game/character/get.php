<?php
header("Access-Control-Allow-Origin: 'http://teoth.online/API_game/'");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");

try{
    $userID = $_GET['userID'];

    //get data
    $query = "SELECT * FROM characters where userID = '$userID'";
    $result = $dbConn->query($query);
    $char = $result->fetch(PDO::FETCH_ASSOC);
    echo json_encode(
        array(
            "status" => true,
            "message" => "get char",
            "data" => $char
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