<?php
    include "./include/conn-db.php";
    include "./include/session.php";

    session_start();

    $sess_Username = $_SESSION["username"];

    $me_query1 = "select * from users where username = '" . $sess_Username . "'";

    $selectQuery = $mysql->query($me_query1);
    while($row = $selectQuery->fetch_assoc()){
        $me_username = $row["username"];
        $me_profile_image = $row["avatar"];
        $admin_flag = $row["flag_admin"];
        $me_uid = $row["user_id"];
        $flag_admin = $row["flag_admin"];
        // echo $us;
    }

    $_SESSION['id'] = $me_uid;
    $sess_uid = $_SESSION['id'];

    $flag_premium = "premium";

    // payment
// if(isset($_POST["pay_submit"]) && $_POST["pay_submit"] == "pay"){
    
//     $query_comment_post = $mysql->prepare("update users set flag_premium = ?, premium_transaction = ? where user_id = ?;");
        
//     $query_comment_post->bind_param("sss",$flag_premium,$_POST["transaction_id"],$sess_uid);
    
//     $query_comment_post->execute();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <style>
        *{
            color: white;
        }
        a{
            text-decoration: none;
        }
        .welcome_username{
            font-size: 40px;
        }
        .btn_edit{
            background-color: green;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            margin-right: 20px;
        }
        .btn_logout{
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            /* margin-right: 20px; */
        }
    </style>
</head>
<body>
    
    
<?php include "./include/header.php" ?>
    <br><br>

    <table>
        <tr>
            
            <td class="profile_img" width='39%'>
                <?php 
                    $user_query = $mysql->query("select * from users where user_id = $sess_uid;");
                    while($row = $user_query->fetch_assoc()){
                        // $user_id = $row["user_id"];
                        $username = $row["username"];
                        $email = $row["email"];
                        $phone_no = $row["phone_no"];
                        $avatar = $row["avatar"];
                        $flag_admin = $row["flag_admin"];
                        $flag_premium = $row["flag_premium"];
                        $expire_premium = $row["expire_premium"];

                        echo "<span class='welcome_username'> Welcome " . $username . "</span><br>";
                        echo "<img src='./avatar/$avatar' width='200px'> <br>";
                        ?>
            </td>
            <td class="profile_details" width='60%'>
                <?php
                    

                       
                        // echo "<img src='./avatar/$avatar' width='200px'> <br>";
                        echo "Username: $username <br>";
                        echo "Email: $email <br>";
                        echo "Contact: $phone_no <br>";
                        echo "Subscription: $flag_premium <br>";

                        if($flag_premium != "free"){
                            echo "Expire Date: $expire_premium <br>";
                        
                        }

                        echo "<br>";
                        
                    } 
                ?>
                <br>
                <a href="./edit.php" class="btn_edit">Profile Setting</a>
                <a href="./logout.php" class="btn_logout">Logout</a>
                
            </td>
            
        
        </tr>
    </table>

    <?php
        // $user_query = $mysql->query("select * from users where user_id = $sess_uid;");
        // while($row = $user_query->fetch_assoc()){
        //     // $user_id = $row["user_id"];
        //     $username = $row["username"];
        //     $email = $row["email"];
        //     $phone_no = $row["phone_no"];
        //     $avatar = $row["avatar"];
        //     $flag_admin = $row["flag_admin"];
        //     $flag_premium = $row["flag_premium"];
        //     $expire_premium = $row["expire_premium"];

        //     echo "<img src='./avatar/$avatar' width='200px'> <br>";
        //     echo "Username: $username <br>";
        //     echo "Email: $email <br>";
        //     echo "Contact: $phone_no <br>";
        //     echo "Subscription: $flag_premium <br>";

        //     if($flag_premium != "free"){
        //         echo "Expire Date: $expire_premium <br>";
            
        //     }

        //     echo "<br>";
            
        // } 
    ?>

    <!-- <form action="" method="post">
        Transaction ID:
        <input type="text" name="transaction_id">
        <input type="submit" name="pay_submit" value="pay">
    </form> -->

    <br><br><br>

    
   

</body>
</html>