<?php
$arrayAirports = [];
include(__DIR__ . "/database/database.php");
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="favicon.png"/>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Airport Flight Challenge!</title>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Airport Flight Challenge!</span>
</nav>

<div class="container ">
    <form method="POST">

        <div class="form-row">
            <div class="col form-group">
                <label for="departure">Partenza</label>
                <select id="departure" class="form-control">
                    <option selected>Choose...</option>
                    <?php
                    foreach ($arrayAirports as $kAirport => $airport) {
                        echo '<option value="' . $kAirport . '">' . $airport['codice'] . ' - ' . $airport['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col form-group">
                <label for="arrival">Arrivo</label>
                <select id="arrival" class="form-control">
                    <option selected>Choose...</option>
                    <?php
                    foreach ($arrayAirports as $kAirport => $airport) {
                        echo '<option value="' . $kAirport . '">' . $airport['codice'] . ' - ' . $airport['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>

    <br>

    <div id="showResponse">

    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script src="js/action.js"></script>

</body>
</html>


