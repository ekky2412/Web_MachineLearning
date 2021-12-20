<?php 
    include 'database.php';
    if(isset($_POST['button'])){
        $username = "paijomanusiaular";
        $anime_id = $_POST['id'];
        $my_score = $_POST['my_score'];
        $useranime = mysqli_query($connect, "select * from useranime where anime_id = '$anime_id'");
        $row = mysqli_num_rows($useranime);
        if($row==0){
            if(mysqli_query($connect,"INSERT INTO useranime (`username`, `anime_id`, `my_score`) VALUES ('".$username."', '".$anime_id."', '".$my_score."')"))
            header("Location: my_score.php");
            else
            die;
        }
        else{
            if(mysqli_query($connect,"UPDATE useranime SET my_score='".$my_score."' WHERE anime_id='".$anime_id."'"))
            header("Location: my_score.php");
            else
            die;
        }

    }
?>