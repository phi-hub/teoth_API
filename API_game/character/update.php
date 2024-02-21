<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $characterID = $_GET['characterID'];
    $level = $data->level;
    $skill_level = $data->skill_level;
    $mp = $data->mp;
    $vit = $data->vit;
    $str = $data->str;
    $ints = $data->ints;
    $luk = $data->luk;
    $position = $data->position;
    $gold = $data->gold;
    $worldID = $data->worldID;
    
    
    $query = "UPDATE characters SET level = '$level', skill_level = '$skill_level', mp = '$mp', vit = '$vit', str = '$str',  
    ints='$ints', luk='$luk',  position='$position',  gold='$gold', worldID='$worldID' WHERE characterID = '$characterID' ";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();

    echo json_encode(
        array(
            "status" => true,
            "message" => "char update"
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