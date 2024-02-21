<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $story = $data->story;
    $level = $data->level;
    $skill_level = $data->skill_level;
    $mp = $data->mp;
    $vit = $data->vit;
    $str = $data->str;
    $ints = $data->ints;
    $luk = $data->luk;
    $positionX = $data->positionX;
    $positionY = $data->positionY;
    $positionZ = $data->positionZ;
    $image = $data->image;
    $gold = $data->gold;
    $userID = $data->userID;
    $worldID = $data->worldID;
    

    // add 
    $query = "INSERT INTO characters SET name = '$name', story = '$story', level = '$level', 
        skill_level = '$skill_level', mp = '$mp', vit = '$vit', str = '$str',  ints='$ints',
        luk='$luk',  positionX='$positionX', positionY='$positionY', positionZ='$positionZ',  image='$image',  gold='$gold',  userID='$userID',  worldID='$worldID'";


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