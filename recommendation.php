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


    <title>Anime</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.php">Home</span></a>
                <a class="nav-item nav-link" href="my_score.php">My Score</a>
                <a class="nav-item nav-link active" href="recommendation.php">Recommendation <span class="sr-only">(current)</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">
            <div class="col-6">
                <h3>Hasil Rekomendasi</h3>
                <div class="content">
                    <p>Rekomendasi untuk anda</p>
                </div>
                <a href="recommendation.php"><button type="button" name="load_data" class="btn btn-info">Refresh</button></a>
                <a href=""></a>
                <?php
                include "database.php";
                $file = "rekomendasi.csv";
                if ($file == NULL) {
                    echo "Data Masih Kosong";
                } else {
                    $handle = fopen($file, "r");
                    $i = 0;
                    mysqli_query($connect, "DELETE FROM rekomendasi");
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        if ($i >= 1) {
                            $query = "INSERT INTO rekomendasi VALUES('" . addslashes($data[0]) . "','" . addslashes($data[1]) . "','" . addslashes($data[0]) . "','" . addslashes($data[2]) . "','" . addslashes($data[0]) . "' )";
                            $hasil = mysqli_query($connect, $query);
                            $dataanime = mysqli_query($connect, "SELECT * FROM rekomendasi");
                            while ($ambil = mysqli_fetch_array($dataanime)) {
                                $id = $ambil['id_anime'];
                                $dataanime1 = mysqli_query($connect, "SELECT * FROM anime WHERE anime_id = '$id'");
                                $ambil1 = mysqli_fetch_array($dataanime1);
                                $url = $ambil1['image_url'];
                                $nama = $ambil1['title'];
                                $id = $ambil1['anime_id'];
                                $update = mysqli_query($connect, "UPDATE rekomendasi SET image_url='" . $url . "', title='" . $nama . "' WHERE id_anime ='" . $id . "' ");
                            }
                        }
                        $i++;
                    }
                }
                ?>
                <div class="table-content">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Anime</th>
                                <th scope="col">ID Anime</th>
                                <th scope="col">My Score</th>
                                <th scope="col">Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "database.php";
                            $i = 1;
                            $anime = mysqli_query($connect, "SELECT * FROM rekomendasi");
                            if ($anime == NULL) {
                            ?>
                                <tr>
                                    <td></td>
                                </tr>
                                <?php
                            } else {
                                while ($row = mysqli_fetch_array($anime)) {
                                ?>
                                    <tr>
                                        <td class="nomer"><?= $i; ?></td> 
                                        <td class="nomer"><?= $row['title'] ?></td>
                                        <td><?= $row['id_anime'] ?></td>
                                        <td><?= $row['my_score'] ?></td>
                                        <td class="img"><img src="<?php echo $row['image_url'] ?>" alt=""></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</body>

</html>