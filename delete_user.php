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
    // echo $us;
}

// rating
$registerQuery = $mysql->prepare("delete from rating where review_user_id = ?;");
        
$registerQuery->bind_param("s", $me_uid);

$registerQuery->execute();


// comment
$registerQuery = $mysql->prepare("delete from comment where comment_user_id = ?;");
        
$registerQuery->bind_param("s", $me_uid);

$registerQuery->execute();



// user
$registerQuery = $mysql->prepare("delete from users where user_id = ?;");
        
$registerQuery->bind_param("s", $me_uid);

$registerQuery->execute();

header("location: logout.php")

?>