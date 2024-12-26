<?php 

include "./include/conn-db.php";
include "./include/session.php";

// rating
$attribute_movie_id = $_GET["attribute_movie_id"];

$registerQuery = $mysql->prepare("delete from rating where review_movie_id = ?;");
        
$registerQuery->bind_param("s", $attribute_movie_id);

$registerQuery->execute();


// comment
$registerQuery = $mysql->prepare("delete from comment where comment_movie_id = ?;");
        
$registerQuery->bind_param("s", $attribute_movie_id);

$registerQuery->execute();


// movie
$registerQuery = $mysql->prepare("delete from movies where movie_id = ?;");
        
$registerQuery->bind_param("s", $attribute_movie_id);

$registerQuery->execute();

header("location: index.php")

?>