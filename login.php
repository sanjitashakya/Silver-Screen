<?php

include "./include/conn-db.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    // $password = MD5($_POST["password"]);
    $password = $_POST["password"];
    $md5password = md5($password);

    $loginQuery = $mysql->prepare("select * from users where username=? and password=?;");
    $loginQuery->bind_param("ss", $username, $md5password);
    $loginQuery->execute();
    $loginQuery->store_result();

    if($loginQuery->num_rows > 0){
        session_start();
        $_SESSION["username"] = $_POST["username"];


        // if($username == "admin"){
        //     header("Location: ./admin_index.php"); 
        // }
        header("Location: ./index.php");
    }    
    else{
        echo "wrong username and/or password";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<style>
          * {
            background-color: #01060A;
            color: white;
        }
form {
  border: 3px solid #f1f1f1;
  width: 300px;
  margin: 0 auto;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.login_button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
  color: white;
  text-decoration: none;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<div class="container">
  <br><br><br><br>
  <!-- <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar"> -->
  <center><h1>Login</h1></center>
  <form method="post">
    <div class="container">
      <label for="username">Username</label>
      <input type="text" placeholder="Enter Username" name="username" required>
      <label for="psw">Password</label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <input type="submit" name="submit" class="login_button" value="Login">
      <!-- <button type="submit">Login</button> -->
      <label>
        <!-- <input type="checkbox" checked="checked" name="remember"> Remember me -->
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <a href="./register.php" class="cancelbtn">Register</a>
      <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
    </div>
  </form>
</div>

</body>
</html>
