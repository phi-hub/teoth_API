<?php
include_once("./database/conection.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $dbConn->query($sql);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        echo "Tài khoản không tồn tại";
        exit();
    }
    else{
        
        //check password
        if($user['password'] != $pswd){
            echo "Mat khau khong chinh xac";
            exit();
        }
        else{
            header("Location: admin_teoth_dsuser.php");
        }
    }
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
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="loginbody">
    <div class="wrapper">
        <form action="/login.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" id="email" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" id="pswd" name="pswd" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Dont have an account? <a href="#">Register</a></p>
            </div>
        </form>
  </div>
</body>
</html>