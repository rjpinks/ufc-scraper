<?php
    require '../vendor/autoload.php';

    // use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;
    use Rjpinks\UfcScraper\Scrapers\Scraper;

    // Gather the URL for each of the fighter's pages.
    // $urlList = [];
    // $alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    // $scraper = new Scraper();
    // foreach ($alphabet as $char) {
    //     $cleanedData = $scraper->scrapeFighterUrls("http://ufcstats.com/statistics/fighters?char=" . $char . "&page=all");
    //     $urlList = array_merge($urlList, $cleanedData);
    // }
    // print_r($urlList);
    $scraper = new Scraper();
    $fightStats = $scraper->scrapeFighterStats(["http://ufcstats.com/fighter-details/88be62d6c1e6dadb"]);
    print_r($fightStats);
?>