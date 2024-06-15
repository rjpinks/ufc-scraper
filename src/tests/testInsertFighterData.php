<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Dto\FighterStatsDto;
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $dtos = [
        new FighterStatsDto(
            "Dustin", "Poirier", "30-9-0 (1 NC)", "69", "155", "72", "Southpaw",
            "1989-01-19 00:00:00.000", "5.30", "0.5", "4.33", "0.52",
            "1.24", ".36", ".64", "1.3"
        ),
        new FighterStatsDto(
            "Conor", "McGregor", "22-6-0", "69", "155", "74", "Southpaw",
            "1988-07-14 00:00:00.000", "5.32", "0.49", "4.66", ".54",
            ".67", ".55", ".66", ".1"
        ),
        new FighterStatsDto(
            "Khabib", "Nurmagomedov", "29-0-0", "70", "155", "70", "Orthodox",
            "1988-09-20 00:00:00.000", "4.1", ".48", "1.75", ".65",
            "5.32", ".48", ".84", "0.8"
        ),
        new FighterStatsDto(
            "Jose", "Ochoa", "7-0-0", "0", "125", "0", "N/A",
            "2000-12-31 00:00:00.000", "0.0", "0.0", "0.0", "0.0",
            "0.0", "0.0", "0.0", "0.0",
        ),
        new FighterStatsDto(
            "David", "Abbott", "10-15-0", "72", "265", "0", "Switch",
            "0000-00-00 00:00:00.000", "1.35", ".3", "3.55", ".38",
            "1.07", ".33", ".66", "0.0"
        )
    ];
    $pdo = new SQLiteConnection;
    $connection = $pdo->connect();
    foreach ($dtos as $dto) {
        $res = $pdo->insertFighterData($connection, $dto);
        if ($res) {
            echo "insertion made";
        } else {
            echo "insertion failed";
        }
    }
?>