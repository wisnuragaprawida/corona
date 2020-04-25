<?php
function getapi($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);

    return json_decode($data, true);
}

$data1 = getapi('https://covid19.mathdro.id/api/countries/indonesia');

function persentase($value, $total)
{

    $persenmat = $value / $total * 100;
    $persen = number_format($persenmat, 2, '.', '');

    return   $persen . '%';
}

$datasembuh = $data1['recovered']['value'];
$total = $data1['confirmed']['value'];
$sembuh = persentase($datasembuh, $total);

$datapositif = $data1['confirmed']['value'] - $data1['recovered']['value'] - $data1['deaths']['value'];
$positif = persentase($datapositif, $total);

$datamati = $data1['deaths']['value'];
$meninggal = persentase($datamati, $total);


?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>corona</title>
</head>

<body>

    <div class="container bg-light">

        <div class="row text-center">
            <div class="col">
                <h1>Indonesia</h1>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col ">
                <div class="progress  mt-4" style="height: 30px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $positif ?>" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">positif <?= $positif ?></div>
                </div>
                <h3 class="mt-4 ">total : <?= $data1['confirmed']['value']; ?> </h3>

                <div class="progress mt-4" style="height: 30px">
                    <div class="progress-bar bg-success" role="progressbar" style=" width : <?= $sembuh ?>" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">sembuh <?= $sembuh ?> </div>
                </div>
                <h3 class="mt-4 pt-1">total :<?= $data1['recovered']['value']; ?></h3>
                <div class="progress mt-4" style="height: 30px">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $meninggal ?>" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">meninggal <?= $meninggal ?> </div>
                </div>
                <h3 class="mt-4 pt-1">total : <?= $data1['deaths']['value']; ?></3>
            </div>

        </div>

        <div class="row text-center mt-4">
            <div class="col">
                <h4>terakhir di perbarui <?= $data1['lastUpdate']; ?></h4>
                <br>
                <br>
                <br>
                <br>
                <br>
                <span>Copyright &copy; programmer yang butuh portofolio <?= date('Y') ?></span>
            </div>


        </div>


















        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>