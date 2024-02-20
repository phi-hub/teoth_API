<?php
include_once("./database/conection.php");
try{
    $email = $_GET['email'];
    $token = $_GET['token'];

    if(empty($email) || empty($token)){
        throw new Exception("Du lieu khong hop le");
    }
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $dbConn->query($query);
    $num = $result->rowCount();
    if ($num == 0){
        throw new Exception("Email khong ton tai");
    }
    $query = "UPDATE users SET is_verified = 1 WHERE email = '$email' ";
    $dbConn->query($query);
    header("Location: login.php");
}catch(Exception $e){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xac thuc thanh cong</title>
</head>
<body>
    
</body>
</html>