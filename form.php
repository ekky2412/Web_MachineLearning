<?php
include 'database.php';
$id = $_GET['id'];
$anime = mysqli_query($connect, "select * from anime where anime_id = '$id'");
$useranime = mysqli_query($connect, "select * from useranime where anime_id = '$id'");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">


    <title>Form</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="my_score.php">My Score</a>
                <a class="nav-item nav-link" href="recommendation.php">Recommendation</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">
            <div class="col-6 my-2">
                <h3>My Score</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-6">

                <?php
                while ($row = mysqli_fetch_array($anime)) {
                ?>
                    <h3><?= $row['title'] ?></h3>
                    <form action="input.php" method="post">
                        <div class="form-group">
                            <input name="id" type="hidden" class="form-control" value="<?= $id ?>">
                        </div>
                        <div class="form-group">
                            <label>My Score</label>
                            <input name="my_score" type="number" class="form-control" id="exampleInputPassword1" min="1" max="10" step="1" value="<?php
                                                                                                                                                        while ($r = mysqli_fetch_array($useranime)) {
                                                                                                                                                            if (isset($r['my_score'])) echo $r['my_score'];
                                                                                                                                                        } ?>">
                        </div>
                        <button name="button" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>