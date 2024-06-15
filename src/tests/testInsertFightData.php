<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Dto\FightStatsDto;
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $dtos = [
        new FightStatsDto(
            "1",
            "1",
            "2",
            "1",
            "0",
            "82",
            "2",
            "0",
            "0",
            "64",
            "1",
            "0",
            "Middleweight",
            "KO/TKO Punches",
            "4",
            "1:34"
        ),
        new FightStatsDto(
            "1",
            "3",
            "4",
            "3",
            "2",
            "20",
            "0",
            "0",
            "0",
            "6",
            "0",
            "0",
            "Light Heavyweight",
            "KO/TKO Punches",
            "1",
            "2:00"
        ),
        new FightStatsDto(
            "1",
            "5",
            "6",
            "5",
            "0",
            "3",
            "4",
            "1",
            "0",
            "7",
            "0",
            "1",
            "Bantamweight",
            "SUB Rear Naked Choke",
            "2",
            "2:22"
        ),
        new FightStatsDto(
            "1",
            "7",
            "8",
            "7",
            "1",
            "24",
            "0",
            "0",
            "0",
            "18",
            "1",
            "2",
            "Middleweight",
            "KO/TKO Spinning Back Elbow",
            "1",
            "4:51"
        ),
        new FightStatsDto(
            "1",
            "9",
            "10",
            "9",
            "1",
            "6",
            "0",
            "0",
            "0",
            "1",
            "0",
            "0",
            "Middleweight",
            "KO/TKO Punch",
            "1",
            "0:20"
        )
    ];
    $pdo = new SQLiteConnection;
    $connection = $pdo->connect();
    foreach ($dtos as $dto) {
        $res = $pdo->insertFightData($connection, $dto);
        if ($res) {
            echo "insertion made";
        } else {
            echo "insertion failed";
        }
    }
?>