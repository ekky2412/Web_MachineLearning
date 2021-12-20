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


    <title>My Score</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
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
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link active" href="my_score.php">My Score <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="recommendation.php">Recommendation</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-6">
                <h3>My Score</h3>
            </div>
        </div>
        <table id="anime" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">My Score</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'database.php';
                $anime = mysqli_query($connect, "select * from useranime u left join anime a on a.anime_id = u.anime_id");
                while ($row = mysqli_fetch_array($anime)) {
                ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['my_score'] ?></td>
                        <td><a href="delete.php?id=<?= $row['anime_id'] ?>" onclick="return confirm('Beneran mau hapus?');" class="btn btn-danger btn-sm float-right mx-2" role="button" aria-pressed="true">Hapus</a>
                        <a href="form.php?id=<?= $row['anime_id'] ?>" class="btn btn-primary btn-sm float-right mx-2" role="button" aria-pressed="true">Edit</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="row mt-5">
            <div class="col-6">
                <h5>Download Data : </h5>
            </div>
        </div>
        <table id="data" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">username</th>
                    <th scope="col">anime_id</th>
                    <th scope="col">my_score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $anime = mysqli_query($connect, "select * from useranime");
                while ($row = mysqli_fetch_array($anime)) {
                ?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['anime_id'] ?></td>
                        <td><?= $row['my_score'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#anime').DataTable();
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv'
                ]
            });
        });
    </script>
</body>

</html>