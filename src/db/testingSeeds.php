<?php
    /*
    This file should be executed only to run testScrapedEventsToFightStatsDtoMapper.php
    This is only going to create some filler data that will satisfy the requirements for the nested functions query.
    This file isn't necessairy if the db been filled.
    */
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $pdo = new SQLiteConnection();
    $connection = $pdo->connect();

    $connection->exec(
        "INSERT INTO fighter (
            first_name,
            last_name,
            record,
            height_inches,
            weight_in_lbs,
            reach_inches,
            stance,
            birthdate,
            strikes_landed_per_min,
            striking_accuracy,
            strikes_absorbed_per_min,
            striking_defence,
            average_takedowns_per_fifteen,
            takedown_accuracy,
            takedown_defence,
            average_submissions_attempted_per_fifteen
        ) VALUES (
            'Nassourdine',
            'Imavov',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Jared',
            'Cannonier',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Dominick',
            'Reyes',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Dustin',
            'Jacoby',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Raul',
            'Rosas Jr.',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Ricky',
            'Turcios',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Brunno',
            'Ferreira',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Dustin',
            'Stoltzfus',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Zach',
            'Reese',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ), (
            'Julian',
            'Marquez',
            'n/a',
            0,
            0,
            0,
            'n/a',
            '1111-11-11 00:00:00.000',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        )"
    );
    $connection->exec(
        "INSERT INTO ufc_event (
            event_name,
            date_occurred,
            event_location
        ) VALUES (
            'The Big Event',
            '1111-22-33 00:00:00.000',
            'Hell'
        )"
    );
    $connection = null;
    $pdo = null;

    echo "testingSeeds.php has been executed\n";
?>