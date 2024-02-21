<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../../database/conection.php");
include_once("../jwt.php");

try {
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $password = $data->password;

    if(empty($email) || empty($password)){
        throw new Exception("Du lieu khong duoc de trong");
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $dbConn->query($query);
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user){
        throw new Exception("Email chua duoc dang ky");
    }
    else{
        //check password
        $pswd = $user['password'];
        if($password != $pswd){
            throw new Exception("Mat khau khong dung");
        }
        else{
            //creat token
            // $token = array(
            //     "id" => $user['id'],
            //     "email" => $user['email'],
            //     "name" => $user['name'],
            //     "exp" =>(time() +60)
            // );
            //$header = array('alg' => 'HS256', 'type' => 'JWT');
            //$jwt = generate_jwt($header, $token);
            echo json_encode(
                array(
                    "status" => true,
                    "message" => "Dang nhap thanh cong",
                    "data" => $user
                )
            );
        }
    }

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