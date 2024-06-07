<?php
    require '../vendor/autoload.php';

    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $pdo = (new SQLiteConnection())->connect();
    if ($pdo != null)
        echo 'Connected to the SQLite database successfully!' . PHP_EOL;
    else
        echo 'Whoops, could not connect to the SQLite database!' . PHP_EOL;
?>