
<?php
include "./include/conn-db.php";
include "./include/session.php";

session_start();

$sess_Username = $_SESSION["username"];

$me_query1 = "select * from users where username = '" . $sess_Username . "'";

$selectQuery = $mysql->query($me_query1);
while($row = $selectQuery->fetch_assoc()){
    $me_username = $row["username"];
    $me_password = $row["password"];
    $me_profile_image = $row["avatar"];
    $admin_flag = $row["flag_admin"];
    $me_uid = $row["user_id"];
    $email = $row["email"];
    $phone = $row["phone_no"];
    // echo $us;
}

$_SESSION['id'] = $me_uid;
$sess_uid = $_SESSION['id'];


if(isset($_POST["submit"]) && $_POST["submit"] == "Update"){

    // file
    if (isset($_FILES['image']['error']) && $_FILES['image']['error']== 0 ) {
        if (isset($_FILES['image']['size']) && $_FILES['image']['size'] < 4000000) {
            $file_types = ['image/jpeg','image/png','image/jpg'];
            if (in_array($_FILES['image']['type'], $file_types)) {
                //chmod('images', 0777);
                 $pname = uniqid() . '_' . $_FILES['image']['name'];
                if (move_uploaded_file($_FILES['image']['tmp_name'], 'avatar/' .$pname )) {
                    echo 'Success';
                } 
                else {
                    echo 'Image upload failed';
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

    // echo "<script>alert('test 1 data failed');</script>";
     

    $registerQuery = $mysql->prepare("update users set email = ?, phone_no = ?, avatar =? where user_id = ?;");

    $registerQuery->bind_param("ssss",$_POST["email"],$_POST["phone"], $pname, $sess_uid);
    
    $registerQuery->execute();

            
        
}

if(isset($_POST["change_password"]) && $_POST["change_password"] == "Change Password"){
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $repeat_password = $_POST["repeat_password"];

    if($new_password == $repeat_password && md5($current_password) == $me_password){
        $query_comment_post = $mysql->prepare("update users set password = ? where user_id = ?;");
        
        $query_comment_post->bind_param("ss",md5($new_password),$sess_uid);
        
        $query_comment_post->execute();
        echo "<script>alert('password Change');</script>";
    }
    else{
        echo "<script>alert('Password Incorrect');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<style>
    *{
        color: white;
        background-color: #01060A;
        
    }
    form{
        font-size: 25px;
    }
    input[type=text], input[type=password], input[type=email] {
        width: 400px;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    input[type="submit"]{
        background-color: green;
        color: white;
        padding: 15px 30px;
        /* width: 120px; */
        border-radius: 8px;
        text-decoration: none;
        border: none;
        font-size: 20px;
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
    .delete_user{
        background-color: red;
        color: white;
        padding: 15px 30px;
        width: 120px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        font-size: 20px;
        margin-left: 15px;
        text-decoration: none;
    }
    </style>
<body>


<?php include "./include/header.php" ?>
<br><br>

<table>
    <tr>
        <td width="60%">
            <form method="post"  enctype="multipart/form-data" >
                <div class="container">
                    <!-- <label for="fname">First Name</label>
                    <input type="text" placeholder="Enter First Name" name="fname" required>
                    <label for="lname">Last Name</label>
                    <input type="text" placeholder="Enter Last Name" name="lname" required> -->
                    <input type="file" name="image">
                    <br><br>
                    <label for="email">Email Address</label>
                    <input type="email" placeholder="Enter Email Address" name="email" value="">
                    <br><br>
                    <label for="contact">Enter Contact</label>
                    <input type="text" placeholder="Enter Contact" name="phone" value="">
                    <br><br>
                    <!-- <button type="submit">Register</button> -->
                    <input type="submit" name="submit" value="Update">
                    <a href="./delete_user.php" class="delete_user">Delete Account</a>
                </div>
            </form>
        </td>
        <td width="39%">
            <form method="post"   >
                <div class="container">
                    
                <label for="current_password">Current Password</label>
                    <input type="password" placeholder="Enter Current Password" name="current_password" value="">
                    <br><br>
                    <label for="new_password">New Password</label>
                    <input type="password" placeholder="Enter New Password" name="new_password" value="">
                    <br><br>
                    <label for="repeat_password">Repeat New Password</label>
                    <input type="password" placeholder="Enter Repeat New Password" name="repeat_password" value="">
                    <br><br>
                    <input type="submit" name="change_password" value="Change Password">
                </div>
            </form>

        </td>
    </tr>
</table>





    
</body>
</html>