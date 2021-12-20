<?php 
    include 'database.php';
    $anime_id = $_GET['id'];
    if(mysqli_query($connect,"DELETE FROM useranime WHERE anime_id = ".$anime_id.""))
    header("Location: my_score.php");
    else
    die;
?>