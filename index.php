<?php
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
include "./include/conn-db.php";
include "./include/session.php";

// session_start();

$sess_Username = $_SESSION["username"];

$me_query1 = "select * from users where username = '" . $sess_Username . "'";

$selectQuery = $mysql->query($me_query1);
while ($row = $selectQuery->fetch_assoc()) {
    $me_username = $row["username"];
    $me_profile_image = $row["avatar"];
    $admin_flag = $row["flag_admin"];
    $me_uid = $row["user_id"];
    $flag_admin = $row["flag_admin"];
    $user_subscription = $row["flag_premium"];
    $user_expire_date = $row["expire_premium"];
    // echo $us;
}

// Expire Premium
$current_date = date("Y-m-d");

$date1 = "1998-11-24"; 
$date2 = "1997-03-26"; 
  
// Use comparison operator to  
// compare dates 
if ($current_date > $user_expire_date){
    $form_flag_premium = "free";
    $query_premium_deactivate = $mysql->prepare("update users set  flag_premium = ?  where user_id = ?;");
        
    $query_premium_deactivate->bind_param("ss",$form_flag_premium, $get_activation_user_id);
    
    $query_premium_deactivate->execute();
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
    <title>Home</title>
    <style>
        * {
            background-color: #01060A;
            color: white;
        }

        .container {
            display: flex;
        }

        .btn_upload {
            background-color: green;
            color: white;
            padding: 15px 30px;
            width: 120px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 20px;
        }

        .movie_wrapper {
            display: inline-block;
            background-color: #262b31;
            padding: 10px;
            margin: 20px;
            border-radius: 8px;
            color: white;
        }

        .movie_wrapper img {
            width: 200px;
            height: 200px;
        }

        .main_recomm_high_rating .text {
            font-size: 40px;
        }

        .main_recomm_high_rating img {
            width: 200px;
            height: 200px;
            margin: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <?php include "./include/header.php" ?>
    <br><br>

    <?php

    if ($flag_admin == "1") {
        echo "<a href='./admin_upload.php' class='btn_upload'>upload</a>";
        echo "<a href='./user_payment.php' class='btn_upload'>User Payment</a>";
        echo "<br>";
        echo "<br>";
    }
    ?>

    <div class="container">

        <!-- Main Movie -->
        <div class="main_movie">
            <?php

            $movie_query = $mysql->query("select * from movies $subscription_query $movie_select order by movie_id desc limit 31;");
            while ($row = $movie_query->fetch_assoc()) {
                echo "<div class='movie_wrapper'>";
                $movie_id = $row["movie_id"];
                $movie_name = $row["movie_name"];
                $movie_upload_name = $row["movie_upload_name"];
                $movie_upload_image = $row["movie_upload_image"];
                $release_date = $row["release_date"];

                ?>


                <a href="./view_movie.php?attribute_movie_id=<?php echo $movie_id ?>">
                    <img src="./thumnail/<?php echo $movie_upload_image; ?>">
                </a>

                <?php
                echo "<br>";
                echo $movie_name . "<br>  " . $release_date;


                echo '</div>';


            }

            ?>
        </div>

        <!-- High Rating Recommendation-->
        <td width='10'>
        <div class="main_recomm_high_rating">
            <table class="recommendation_table">
                <span class="text">Recomendation</span><br>

                <?php
                $recom_query = $mysql->query("select review_movie_id, sum(review_score) from rating;");
                while ($row = $recom_query->fetch_assoc()) {
                    $rating_movie_id = $row["review_movie_id"];
                    
                    $recom_query = $mysql->query("select * from movies $subscription_query limit 5");

                    while ($row = $recom_query->fetch_assoc()) {
                        $movie_id = $row["movie_id"];
                        $movie_name = $row["movie_name"];
                        $movie_upload_name = $row["movie_upload_name"];
                        $movie_upload_image = $row["movie_upload_image"];
                        $release_date = $row["release_date"];

                        echo "<tr>";
                        echo "<td><a href='./view_movie.php?attribute_movie_id=$movie_id'>  <img src='./thumnail/$movie_upload_image'>   </a></td>";
                        echo "<td>$movie_name <br> $release_date </td> ";
                        echo "</tr>";
                        

                    }
                    
                }
                ?>

            </table>
        </div>
    </div>

</body>

</html>