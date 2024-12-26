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
    
    $flag_admin = $row["flag_admin"];
    $me_uid = $row["user_id"];
    $flag_premium = $row["flag_premium"];
    // echo $us;
}

if($admin_flag != "1"){
    header("location: index.php");
}

// echo "test<br>";

// print_r($_FILES);
    if(isset($_POST['upload'])){

        $maxFileSize = 5 * 1073741824; // 5 GB in bytes uplode size
        // file
        if (isset($_FILES['thumnail']['error']) && $_FILES['thumnail']['error']== 0 ) {
            if (isset($_FILES['thumnail']['size']) && $_FILES['thumnail']['size'] < $maxFileSize) {
                $file_types = ['image/jpeg','image/png','image/jpg'];
                if (in_array($_FILES['thumnail']['type'], $file_types)) {
                    //chmod('thumnails', 0777);
                    $thumnail = uniqid() . '_' . $_FILES['thumnail']['name'];
                    if (move_uploaded_file($_FILES['thumnail']['tmp_name'], 'thumnail/' .$thumnail )) {
                        echo 'Success';
                    } 
                    else {
                        echo 'thumnail upload failed';
                    }
                } 
                else {
                    $err['thumnail'] = 'thumnail type mismatch';
                }
            } 
            else {
                $err['thumnail'] = 'thumnail size exceed';
            }
        } 
        else {
            $err['thumnail'] = 'Please upload thumnail';
        }
        
        
        echo "test1<br>";
        if (isset($_FILES['movie']['error']) && $_FILES['movie']['error']== 0 ) {
            $file_types = ['video/mp4','video/mkv'];
                
            echo "test2<br>";
            if (in_array($_FILES['movie']['type'], $file_types)) {
                    //chmod('images', 0777);
                    
                // echo "test3<br>";
                  $pname = uniqid() . '_' . $_FILES['movie']['name'];
                if (move_uploaded_file($_FILES['movie']['tmp_name'], 'movie/' .$pname )) {
                    echo 'Success';

                    $registerQuery = $mysql->prepare("insert into movies(movie_name, movie_upload_name, movie_upload_image, movie_description, movie_genre, movie_subscription, release_date, movie_language)values (?,?,?,?,?,?,?,?);");
    
                    $registerQuery->bind_param("ssssssss",$_POST["name"],$pname,$thumnail,$_POST["description"],$_POST["genre"],$_POST["subscription"],$_POST["date"],$_POST["language"]);
                    
                    $registerQuery->execute();
                } 
                else {
                echo 'Movie upload failed';
                }
            } 
            else {
                $err['movie'] = 'Movie type mismatch';
            }
        } 
        else {
            $err['movie'] = 'Movie size exceed';
        }
    } 
    else {
        $err['movie'] = 'Please upload Movie';
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        *{
            color: white;
            background-color: #01060A;
            
        }
        form{
            font-size: 25px;
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
</head>
<body>
    <?php include "./include/header.php"; ?>
    <form method="post" enctype="multipart/form-data">
        <label for="movie">Movie</label>
        <input type="file" name="movie">
        <br><br>
        <label for="movie">Thumnail</label>
        <input type="file" name="thumnail">
        <br><br>
        <label for="name">Name</label>
        <input type="text" name="name">
        <br><br>
        <label for="subscription">Subscription</label>
        <input type="radio" name="subscription" value="free">Free
        <input type="radio" name="subscription" value="premium">Premium
        <br><br>
        <label for="description">Description</label>
        <input type="text" name="description">
        <br><br>
        <label for="genre">Genre</label>
        <select name="genre" id="genre" label="genre">
            <option value="Action">Action</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Horror">Horror</option>
            <option value="Romance">Romance</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Thriller">Thriller</option>
        </select>
        <br><br>
        <label for="date">Date</label>
        <input type="text" name="date">
        <br><br>
        <label for="language">Language</label>
        <input type="text" name="language">
        <br><br>
        
        <input type="submit" name="upload" value="upload">
    </form>
</body>
</html>