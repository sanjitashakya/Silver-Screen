<?php
include "./include/conn-db.php";

if(isset($_POST["submit"]) && $_POST["submit"] == "Register"){

    // file
    if (isset($_FILES['image']['error']) && $_FILES['image']['error']== 0 ) {
        if (isset($_FILES['image']['size']) && $_FILES['image']['size'] < 4000000) {
            $file_types = ['image/jpeg','image/png','image/jpg'];
            if (in_array($_FILES['image']['type'], $file_types)) {
                //chmod('images', 0777);
                 $pname = uniqid() . '_' . $_FILES['image']['name'];
                if (move_uploaded_file($_FILES['image']['tmp_name'], 'avatar/' .$pname )) {
                    echo 'Success';
                    $profile_upload_flag = 1;
                } 
                else {
                    $err['image'] = 'Image upload failed';
                }
            } 
            else {
                $err['image'] = 'Image type mismatch';
            }
        } 
        else {
            $err['image'] = 'Image size exceed';
        }
    } 
    else {
        $err['image'] = 'Please upload image';
    }

    //echo "<script>alert('test 1 data failed');</script>";
    if($profile_upload_flag != 1){
        $error_image = $err['image'];
        echo "<script>alert('$error_image')</script>";
    }
     
    $password = $_POST["password"];
    $md5password = md5($password);

    // Dublicate Data
    $dublicate_query = $mysql->query("select * from users;");
    while($row = $dublicate_query->fetch_assoc()){
        $username = $row["username"];
        $phone = $row["phone_no"];
        $email = $row["email"];

        //echo "<script>alert('test 2 data failed');</script>";
        
        if($_POST["username"] == $username || $_POST["email"] == $email || $_POST["phone"] == $phone){
            // echo "<script> alert 'duplicate error;' </script>";
            $flag = 1;
            // break;
        }
    }

    $regex_validate_error = 0;

    if(!preg_match("/(([A-Za-z0-9\_]+))/i", $_POST["username"]) ){
        echo "<script>alert('username is not validate')</script>";
        $regex_validate_error = 1;
    }

    if(strlen($_POST["password"] < 8 )){
        echo "<script>alert('password is not validate')</script>";
        $regex_validate_error = 1;
    }

    if(!preg_match("/([a-z|0-9]+@[a-z|0-9]+.[a-z|0-9]+)/i", $_POST["email"]) ){
        echo "<script>alert('email is not validate')</script>";
        $regex_validate_error = 1;
    }
    
    if(!preg_match("/98[0-9]{8}/i", $_POST["phone"]) ){
        echo "<script>alert('phone is not validate')</script>";
        $regex_validate_error = 1;
    }
    
    if($regex_validate_error != 1 && $profile_upload_flag == 1){
    
        if($flag != 1 ){
            $flag_premium = "free";
            $flag_admin = 0;

            $registerQuery = $mysql->prepare("insert into users(username, password, email, phone_no, avatar, flag_admin, flag_premium, expire_premium)values (?,?,?,?,?,?,?,?);");
        
            $registerQuery->bind_param("ssssssss",$_POST["username"],$md5password,$_POST["email"],$_POST["phone"], $pname, $flag_admin, $flag_premium, date("Y-m-d"));
            
            $registerQuery->execute();

            header("location: login.php");
        }

        else{
            echo "<script>alert('Dublicate data failed');</script>";
        }
    }
}




?>

<!DOCTYPE html>
<html>
<head>
<title>Register Form</title>
<style>
    /* Same CSS as above */
    * {
            background-color: #01060A;
            color: white;
        }
    form {
        border: 3px solid #f1f1f1;
        width: 300px;
        margin: 0 auto;
    }

    input[type=text], input[type=password], input[type=email] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .register_button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .btn_register:hover {
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
    input[type=file]::file-selector-button {
        margin-right: 20px;
        border: none;
        background: #F23A0C;
        padding: 10px 20px;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }

    input[type=file]::file-selector-button:hover {
        background: #0d45a5;
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
    <!-- <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar"> -->
    <center><h1>Register</h1></center>
    <form method="post"  enctype="multipart/form-data" >
        <div class="container">
            <!-- <label for="fname">First Name</label>
            <input type="text" placeholder="Enter First Name" name="fname" required>
            <label for="lname">Last Name</label>
            <input type="text" placeholder="Enter Last Name" name="lname" required> -->
            <input type="file" name="image">
            <br><br>
            <label for="username">username</label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <br><br>
            <label for="password">Password</label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br><br>
            <label for="psw-confirm">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="psw-confirm" required>
            <br><br>
            <label for="email">Email Address</label>
            <input type="email" placeholder="Enter Email Address" name="email" required>
            <br><br>
            <label for="contact">Enter Contact</label>
            <input type="text" placeholder="Enter Contact" name="phone" required>
            <br><br>
            <!-- <button type="submit">Register</button> -->
            <input type="submit" name="submit" value="Register" class="register_button">
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <a href="./login.php" class="cancelbtn">Login</a>
            <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
        </div>
    </form>
</div>

</body>
</html>
