<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("/PHP/database/conection.php");
use PHPMailer\PHPMailer\PHPMailer;

include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/utilities/PHPMailer-master/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/utilities/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/utilities/PHPMailer-master/src/Exception.php';

try {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username;
    $email = $data->email;
    $password = $data->password;
    $available = $data->available;
    $balance = $data->balance;
    $name = $data->name;

    //check data
    if(empty($email) || empty($password) || empty($username) || empty($name) ){
        throw new Exception("Du lieu khong duoc de trong");
    }

    //check email have
    $query = "SELECT * FROM users WHERE email = '$email'";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    if ($num > 0){
        throw new Exception("Email da ton tai");
    }
    else{
        // create account
        $query = "INSERT INTO users SET email = '$email', password = '$password', name = '$name', username = '$username', available = '$available', balance = '$balance'";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();

        // //tạo token bằng md5
        // $token = md5($email . time());
        
        // //gửi email xác thực
        // $link = "<a href='http://127.0.0.1:1234/verify_account.php?email="
        // . $email . "&token=" . $token . "'>Xác thực tài khoản nè</a>";
        // $mail = new PHPMailer();
        // $mail->CharSet = "utf-8";
        // $mail->isSMTP();
        // $mail->SMTPAuth = true;
        // $mail->Username = "phindtps23735@fpt.edu.vn";
        // $mail->Password = "emxjlclmvphgfycs";
        // $mail->SMTPSecure = "ssl";
        // $mail->Host = "ssl://smtp.gmail.com";
        // $mail->Port = "465";
        // $mail->From = "phindtps23735@fpt.edu.vn";
        // $mail->FromName = "Cafein8";
        // $mail->addAddress($email, 'Hello');
        // $mail->Subject = "Xác thực tài khoản";
        // $mail->isHTML(true);
        // $mail->Body = "Click on this link to reset password " . $link . " ";
        // $res = $mail->Send();

        
        echo json_encode(
            array(
                "status" => true,
                "message" => "Dang ky thanh cong"
            )
        );
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