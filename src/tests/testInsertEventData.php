<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Dto\EventDataDto;
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $dtos = [
        new EventDataDto(
            "UFC Fight Night: Cannonier vs. Imavov",
            "2024-06-08 00:00:00.000",
            "Louisville, Kentucky, USA"
        ),
        new EventDataDto(
            "UFC 2: No Way Out",
            "1994-03-11 00:00:00.000",
            "Denver, Colorado, USA",
        ),
        new EventDataDto(
            "UFC Fight Night: Diaz vs Neer",
            "2008-09-17 00:00:00.000",
            "Omaha, Nebraska, USA",
        ),
        new EventDataDto(
            "UFC 94: St-Pierre vs Penn 2",
            "2009-01-31 00:00:00.000",
            "Las Vegas, Nevada, USA",
        ),
        new EventDataDto(
            "UFC Fight Night: McGregor vs Siver",
            "2015-01-18 00:00:00.000",
            "Boston, Massachusetts, USA",
        )
    ];
    $pdo = new SQLiteConnection;
    $connection = $pdo->connect();
    foreach ($dtos as $dto) {
        $res = $pdo->insertEventData($connection, $dto);
        if ($res) {
            echo "insertion made";
        } else {
            echo "insertion failed";
        }
    }
?>