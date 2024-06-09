<?php
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    if (!file_exists(__DIR__ . "\ufcstats.sqlite")) {
        $db = new SQLite3("ufcstats.sqlite");
    }
    $pdo = new \Pdo("sqlite:" . __DIR__ . "\ufcstats.sqlite");

    $pdo->exec("DROP TABLE IF EXISTS fighter");
    $pdo->exec("DROP TABLE IF EXISTS fight");

    $pdo->exec(
    "CREATE TABLE fighter (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        first_name VARCHAR NOT NULL,
        last_name VARCHAR NOT NULL,
        record VARCHAR NOT NULL,
        height_inches INTEGER NOT NULL,
        weight_in_lbs INTEGER NOT NULL,
        reach_inches INTEGER NOT NULL,
        stance VARCHAR NOT NULL,
        birthdate TEXT NOT NULL, /* DATE: YYYY-MM-DD HH:MM:SS.SSS */
        strikes_landed_per_min REAL NOT NULL,
        striking_accuracy REAL NOT NULL,
        strikes_absorbed_per_min REAL NOT NULL,
        opponent_strikes_missed REAL NOT NULL,
        average_takedowns_per_fifteen REAL NOT NULL,
        takedown_accuracy REAL NOT NULL,
        takedown_defence REAL NOT NULL,
        average_submissions_attempted_per_fifteen REAL NOT NULL,
    )"
    );
    $pdo->exec(
    "CREATE TABLE fight (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        fighter_one_id INTEGER NOT NULL,
        fighter_two_id INTEGER NOT NULL,
        winner INTEGER NOT NULL,
        fighter_one_knockdowns INTEGER NOT NULL,
        fighter_one_strikes INTEGER NOT NULL,
        fighter_one_takedowns INTEGER NOT NULL,
        fighter_one_submission_attempts INTEGER NOT NULL,
        fighter_two_knockdowns INTEGER NOT NULL,
        fighter_two_strikes INTEGER NOT NULL,
        fighter_two_takedowns INTEGER NOT NULL,
        fighter_two_submission_attempts INTEGER NOT NULL,
        ufc_event VARCHAR NOT NULL,
        result_method VARCHAR NOT NULL,
        last_round INTEGER NOT NULL,
        ending_time VARCHAR NOT NULL,

        FOREIGN KEY (fighter_one_id) REFERENCES fighter (id),
        FOREIGN KEY (fighter_two_id) REFERENCES fighter (id)
    )"
    );

    echo "Database created\n";
?>