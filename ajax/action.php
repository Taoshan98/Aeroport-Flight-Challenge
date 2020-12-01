<?php
$arrayAirports = [];
$arrayFlights = [];
include(__DIR__ . "/../database/database.php");

define('MAX', 999999); // definiamo un costo altissimo

$departure = $_POST['departure'];
$arrival = $_POST['arrival'];

// Inizializziamo una coda Q, questa coda avrà come nodi i singoli aeroporti
$queue = $arrayAirports;

$cost = [];
$prev = [];

/**
 * Inizializziamo un array che mantiene il costo di un'intera tratta dall'aeroporto di partenza a quello di destinazione:
 * Es. ('NA' => 2, 'MI' => 3) significa che l'aeroporto di partenza ha una tratta per NA che costa 2 e per MI che costa 3
 *
 * Per ogni elemento di questa coda inizializziamo il costo di un volo tra partenza e destinazione al valore MAX
 * Il volo che ha partenza e destinazione uguali ha invece costo pari a 0.
 */
foreach ($queue as $airport) {
    $cost[$airport['codice']] = ($airport['codice'] === $departure) ? 0 : MAX;
    $prev[$airport['codice']] = null;
}

/**
 * PROCEDURA GENERALE:
 * Scorriamo gli elementi della coda finché non è vuota, estraiamo la destinazione che ha costo minimo dall'aeroporto di partenza,
 * (banalmente la prima iterazione del ciclo sarà sull'aeroporto di partenza in quanto ha costo 0 mentre gli altri MAX)
 * Controlliamo tutti i voli diretti dall'aeroporto di partenza e calcoliamo il loro costo, che sarà pari a:
 * $c = costo dell'intera tratta calcolata finora + costo dall'aeroporto attuale a quello di destinazione
 * se $c è minore del costo attuale allora lo memorizziamo.
 */
while (!empty($queue)) {

    /**
     * In questa variabile memorizziamo l'array dei costi inizializzato alle righe 19-22, rimuovendo
     * però tutti gli aeroporti che sono stati estratti dalla coda nelle iterazioni precedenti
     */
    $cost_tmp = array();
    foreach ($cost as $k => $ct) {
        if (array_key_exists($k, $queue)) {
            $cost_tmp[$k] = $ct;
        }
    }

    /**
     * memorizziamo l'aeroporto che attualmente ha il costo minore dall'aeroporto di partenza:
     * in $code prendiamo il codice dell'aeroporto che ha costo minimo dalla partenza scelta,
     * usiamo $code per recuperare l'elemento nella coda che ha come chiave il codice di quell'aeroporto
     */
    $code = array_keys($cost_tmp, min($cost_tmp));
    $element = $queue[$code[0]];

    // Rimuoviamo l'aeroporto dalla coda
    unset($queue[$code[0]]);

    /**
     * Controlliamo se da questo aeroporto ci sono dei voli diretti recuperandoli direttamente dal result del database
     */
    $neighbours = array_filter($arrayFlights, static function ($flight) use ($element) {
        return $flight['departure'] === $element['codice'];
    });

    /**
     * Per ogni destinazione diretta dall'aeroporto che abbiamo memorizzato, calcoliamo il costo di queste tratte:
     * tale costo sarà pari al costo dell'intera tratta (quindi la somma di tutti gli scali) + il costo del volo diretto:
     * es: se da Napoli vogliamo arrivare a Milano facendo scalo a Roma, il costo sarà:
     * $c = costo della tratta Napoli-Roma + costo della tratta Roma-Milano
     * $c viene confrontato con il valore presente nell'array dei costi, se è minore lo sostituirà.
     *
     * In più, memorizziamo in $prev le tratte percorse finora
     */
    foreach ($neighbours as $v) {
        $c = $cost[$element['codice']] + $v['costo'];
        if ($c < $cost[$v['arrival']]) {
            $cost[$v['arrival']] = $c;
            $prev[$v['arrival']] = $element['codice'];
        }
    }
}

/**
 * A questo punto abbiamo il costo minimo di OGNI tratta partendo da Napoli a tutti gli altri aeroporti,
 * usiamo l'array $prev memorizzato in precedenza per verificare tutte le singole tratte da percorrere per
 * arrivare alla destinazione
 */
$seq = array();
$d = $arrival;
while ($prev[$d] !== null && !empty($prev[$d])) {
    $seq[] = $d;
    $d = $prev[$d];
}

$response = array(
    "text" => "Non sono state trovate tratte ottimali con al massimo 2 scali"
);

$seq = array_reverse($seq);

array_pop($seq);

if (count($seq) < 2) {

    $stops = [];
    foreach (array_reverse($seq) as $stop) {
        $stops[$stop] = $arrayAirports[$stop]['nome'];
    }

    $response = array(
        "stops" => $stops,
        "text" => "Il costo minore per la tratta selezionata è di " . $cost[$arrival] . "€ e comprende i seguenti scali:",
    );
}

if ($departure === $arrival) {
    $response = array(
        "text" => "la tratta selezionata non esiste, riprova.",
    );
}

echo json_encode($response);
