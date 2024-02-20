<?php

include_once("./database/conection.php");
try{
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $token = $_POST['token'];
        $password = $_POST['password'];
        $comfirm_password = $_POST['comfirm_password'];

        $query = "SELECT id FROM reset_password WHERE email = '$email' 
            AND token = '$token' 
            AND avaiable = 1 
            AND  createAt >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
        $result = $dbConn->query($query);
        if(!$result){
            //404
        }
        //update pass
        $dbConn->query("UPDATE users SET password = '$password' WHERE email = '$email' ");

        //update token
        $dbConn->query("UPDATE reset_password SET avaiable = 0
                            WHERE email = '$email' AND token = '$token' ");
    }
    else{
        $email = $_GET['email'];
        $token = $_GET['token'];
        
        if(isset($email) || isset($token)){
            //404
        }

        //check
        $query = "SELECT id FROM reset_password WHERE email = '$email' 
            AND token = '$token' 
            AND avaiable = 1 
            AND  createAt >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
        $result = $dbConn->query($query);
        if(!$result){
            //404
        }
    }
}catch(Exception $e){

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h2 style="margin-left: 310px;">Doi mat khau</h2>
    <form action="/reset_password.php" method="post" class="container mt-3">
    <div class="form-group">
        <label for="password">password:</label>
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label for="comfirm_password">Password:</label>
        <input type="password" class="form-control" id="comfirm_password" name="comfirm_password">
    </div>
    
    <button name="submit" type="submit" class="btn btn-default">Submit</button>
    </form>
</body>
</html>