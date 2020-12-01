<?php
$dbCon = new PDO("mysql:host=localhost;dbname=challenge", 'root');

$arrayAirports = [];
foreach ($dbCon->query("SELECT * FROM `aeroporti`") as $a) {
    $element = array(
        'codice' => $a['codice'],
        'nome' => $a['nome']
    );

    $arrayAirports[$a['codice']] = $element;
}

$arrayFlights = [];
foreach ($dbCon->query( "SELECT * FROM `voli`") as $f) {
    $element = array(
        'codice' => $f['codice'],
        'departure' => $f['id_departure'],
        'arrival' => $f['id_arrival'],
        'costo' => $f['costo']
    );

    $arrayFlights[$f['codice']] = $element;
}
