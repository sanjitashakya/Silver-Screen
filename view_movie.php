<?php
error_reporting(0);
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

$attribute_movie_id = $_GET["attribute_movie_id"];

// review
if(isset($_POST["submit_review"]) && $_POST["submit_review"] == "submit"){
    
    $query_comment_post = $mysql->prepare("insert into rating(review_movie_id, review_user_id, review_score)values (?,?,?);");
        
    $query_comment_post->bind_param("sss",$attribute_movie_id,$sess_uid,$_POST["review_score"]);
    
    $query_comment_post->execute();
}

// comment
if(isset($_POST["submit_comment"]) && $_POST["submit_comment"] == "post"){
    
    $query_comment_post = $mysql->prepare("insert into comment(comment_movie_id, comment_user_id, comment_username, comment_avatar, comment_text)values (?,?,?,?,?);");
        
    $query_comment_post->bind_param("sssss",$attribute_movie_id,$sess_uid,$sess_Username,$me_profile_image,$_POST["text_comment"]);
    
    $query_comment_post->execute();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        *{
            color: white;
        }
        video{
            width: 90%;
        }
        input{
            margin-left: 40px;
        }
        
        input[type=text], input[type=password], input[type=email] , select{
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
        .text{
            font-size: 20px;
        }
        .btn_delete{
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
        .td_image img{
            width: 40px;
            border-radius: 50%;
            border: solid greenyellow 2px;
        }
        .comment_table td{
            padding: 10px;
        }
        .recommendation_table img{
            width: 40px;
        }
        .recommendation_table td{
            padding: 10px;
            background-color: #262b31;
        }
        .recommendation_table table, .recommendation_table tr, .recommendation_table td{
            border-collapse: collapse;

        }
    </style>
</head>
<body>
    
    <?php include "./include/header.php" ?>
    <br><br>
    
    <!-- movie -->
    <?php
        $movie_query = $mysql->query("select * from movies where movie_id = $attribute_movie_id;");
        while($row = $movie_query->fetch_assoc()){
            $movie_id = $row["movie_id"];
            $movie_name = $row["movie_name"];
            $movie_upload_name = $row["movie_upload_name"];
            $movie_upload_image = $row["movie_upload_image"];
            $movie_description = $row["movie_description"];
            $movie_genre = $row["movie_genre"];
            $release_date = $row["release_date"];
            $movie_language = $row["movie_language"];
            
    ?>

        <video width="320" height="240" controls>
            <source src='./movie/<?php echo $movie_upload_name ?>'  type="video/mp4">
        </video>
        <br><br>
    <?php 
            echo $movie_name . "<br>";
            echo $movie_genre . "<br>";
            echo $movie_description . "<br>";
            echo $release_date . "<br>";
            echo $movie_language . "<br>";
        } 
    ?>

    <br>
    <br>

    <?php 
    if($flag_admin == "1"){
        echo "<a href='./delete_movie.php?attribute_movie_id=$attribute_movie_id' class='btn_delete'>Delete</a>";
    }
    ?>
    

    <br><br><br>
    <span class="text">Rate The Movie</span><br>
    <form action="" method="post">
        <input type="radio" name="review_score" value="1">1
        <input type="radio" name="review_score" value="2">2
        <input type="radio" name="review_score" value="3">3
        <input type="radio" name="review_score" value="4">4
        <input type="radio" name="review_score" value="5">5
        
        <input type="submit" name="submit_review" value="submit">
    </form>

    <br>
    <span class="text">Overall Rating </span>
    <?php
        $review_score_sum = 0;
        $review_counter = 0;
        $review_view_query = $mysql->query("select * from rating where review_movie_id = $attribute_movie_id;");
        while($row = $review_view_query->fetch_assoc()){
            $review_score = $row["review_score"];
            
            $review_score_sum += $review_score;
            $review_counter += 1;
        }
        if($review_score_sum != 0 ){
            echo ":    * " . ($review_score_sum/$review_counter);
        }
        
        ?>

    <br><br><br>
    
    <table class="wrapper_comment_recom">
        <tr>
            <!-- Comment -->
            <td width="78%">
            <span class="text">Post the Comment</span><br><br>
                <form action="" method="post">
                    <input type="text" name="text_comment" placeholder="Comment: ">
                    <input type="submit" name="submit_comment" value="post">
                </form>

                <br><br><br>
                <span class="text">COMMENT</span><br>
                <table class="comment_table">
                    
                    <?php
                        $comment_query = $mysql->query("select * from comment where comment_movie_id = $attribute_movie_id order by comment_id desc;");
                        while($row = $comment_query->fetch_assoc()){
                            $comment_avatar = $row["comment_avatar"];
                            $comment_username = $row["comment_username"];
                            $comment_text = $row["comment_text"];
                            echo "<tr>";
                            echo "<td class='td_image'> <img src='./avatar/$comment_avatar'>$comment_username</td>";
                            echo "<td>$comment_text</td>";
                            echo "</tr>";
                        }
                    ?>
                    
                </table>
            </td>
            <!-- Recommendation -->
            <td width='20%'>
                <table class="recommendation_table">
                    <span class="text">Similar Movies</span><br>
                    
                    <?php
                        $recom_query = $mysql->query("select * from movies where movie_genre = '$movie_genre' order by movie_id desc limit 4 ;");
                        while($row = $recom_query->fetch_assoc()){                            
                            $movie_id = $row["movie_id"];
                            $movie_name = $row["movie_name"];
                            $movie_upload_name = $row["movie_upload_name"];
                            $movie_upload_image = $row["movie_upload_image"];
                            $release_date = $row["release_date"];

                            echo "<tr>";
                            echo "<td><a href='./view_movie.php?attribute_movie_id=$movie_id'>  <img src='./thumnail/$movie_upload_image'>   </a></td>";
                            echo "<td>$movie_name  $release_date </td> ";

                          
// echo $movie_name . "  " . $release_date ;
                            echo "</tr>";
                        }
                    ?>
                    
                </table>
            </td>
        </tr>
    </table>
    
</body>
</html>