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
    $flag_premium = $row["flag_premium"];
    $flag_admin = $row["flag_admin"];
    // echo $us;
}

if($admin_flag != "1"){
    header("location: index.php");
}


date_default_timezone_set('Asia/Kathmandu');
//$current_date = date("Y-m-d");
//echo "<script>alert($current_date);</script>";

$get_activation_user_id = $_GET["activate_user_id"];
if($get_activation_user_id != NULL){
    $form_flag_premium = "premium";

    $current_date = date("Y-m-d");
    $premium_date = strtotime("+1 year", strtotime($current_date));
    //echo date("Y-m-d", $premium_date);
    
    $query_premium_activate = $mysql->prepare("update users set  flag_premium = ? , expire_premium = ? where user_id = ?;");
        
    $query_premium_activate->bind_param("sss",$form_flag_premium, date("Y-m-d", $premium_date), $get_activation_user_id);
    
    $query_premium_activate->execute();

    //header("location: user_payment.php");
}


// subscription
$subscription_query = "where (movie_subscription = 'free' or movie_subscription = 'premium')";
if ($user_subscription == "free") {
    $subscription_query = "where (movie_subscription = 'free')";
}

$_SESSION['id'] = $me_uid;
$sess_uid = $_SESSION['id'];

?>

<?php

include "./include/conn-db.php";
include "./include/session.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Payment</title>
</head>
<body>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Transaction Key</th>
            <th>Approve</th>
        </tr>
    <?php
        $paymentQuery = $mysql->query("SELECT * from users where flag_premium = 'free' and premium_transaction != '';");
        while($row = $paymentQuery->fetch_assoc()){
            $payment_username = $row["username"];
            $payment_profile = $row["avatar"];
            $payment_user_id = $row["user_id"];
            $payment_flag_premium = $row["flag_premium"];
            $payment_flag_admin = $row["flag_admin"];
            $payment_transaction_key = $row["premium_transaction"];
            // echo $us;
            echo "<tr>";
            echo "<td>$payment_user_id</td>";
            echo "<td>$payment_username</td>";
            echo "<td>$payment_transaction_key</td>";
            echo "<td><a href='./user_payment.php?activate_user_id=$payment_user_id'>Activate</a></td>";
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>