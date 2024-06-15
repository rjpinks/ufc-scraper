<?php
    require '../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Scrapers\Mapper;
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    $urlStack = [];
    $alphabet = range("a", "z");
    $scraper = new Scraper();
    foreach ($alphabet as $letter) {
        $url = "http://ufcstats.com/statistics/fighters?char=". $letter . "&page=all";
        $scrapedPage = $scraper->scrapeFighterUrls($url);
        $urlStack = array_merge($urlStack, $scrapedPage);
        sleep(1);
    }

    echo "all fighter urls scraped\n";

    $mapper = new Mapper();
    $pdo = new SQLiteConnection;
    while ($urlStack) {
        $url = array_pop($urlStack);

        $scrapedFighterStats = $scraper->scrapeFighterStats($url);
        $fighterStatsDto = $mapper->scrapedFighterStatsToDtoMapper($scrapedFighterStats);

        $connection = $pdo->connect();
        $pdo->insertFighterData($connection, $fighterStatsDto);
        $connection = null;
        sleep(1);
    }

    echo "urlStack depleted--now scraping events\n";

    $urlStack = $scraper->scrapeEventUrls("http://ufcstats.com/statistics/events/completed?page=all");
    sleep(1);

    $eventStatsStack = $scraper->scrapeEventStats($urlStack);
    $currentEvent = 1;
    while ($eventStatsStack) {
        $eventStats = array_pop($eventStatsStack);
        $eventDataDto = $mapper->scrapedEventsToEventDataDtoMapper($eventStats);

        $connection = $pdo->connect();
        $pdo->insertEventData($connection, $eventDataDto);
        $connection = null;
        
        while (count($eventStats) > 3) {
            $row = array_pop($eventStats);
            $fightStatsDto = $mapper->scrapedEventsToFightStatsDtoMapper($row, $currentEvent);

            $connection = $pdo->connect();
            $pdo->insertFightData($connection, $fightStatsDto);
            $connection = null;
        }

        $currentEvent++;
    }

    echo "scraping complete!";
?>