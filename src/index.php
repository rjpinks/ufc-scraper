<?php
    require '../vendor/autoload.php';

    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;
    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Scrapers\Cleaner;

    // Gather the URL for each of the fighter's pages.
    $urlList = [];
    $alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    $scraper = new Scraper();
    foreach ($alphabet as $char) {
        $cleanedData = $scraper->scrapeFighterUrls("http://ufcstats.com/statistics/fighters?char=" . $char . "&page=all");
        $urlList = array_merge($urlList, $cleanedData);
    }
    // Parse the data and post into db
    $cleaner = new Cleaner();
    $pdo = new SQLiteConnection();
    $connection = $pdo->connect();
    // foreach ($urlList as $url) {
    //     $cleanedStats = $cleaner->fighterStatsToSql($scraper->scrapeFighterStats($url));
    //     $connection->exec(
    //     "INSERT INTO fighter (
    //         first_name,
    //         last_name,
    //         record,
    //         height_inches,
    //         weight_in_lbs,
    //         reach_inches,
    //         stance,
    //         birthdate,
    //         strikes_landed_per_min,
    //         striking_accuracy,
    //         strikes_absorbed_per_min,
    //         opponent_strikes_missed,
    //         average_takedowns_per_fifteen,
    //         takedown_accuracy,
    //         takedown_defence,
    //         average_submissions_attempted_per_fifteen
    //     ) VALUES (
    //         '$cleanedStats[0]',
    //         '$cleanedStats[1]',
    //         '$cleanedStats[2]',
    //         $cleanedStats[3],
    //         $cleanedStats[4],
    //         $cleanedStats[5],
    //         $cleanedStats[6],
    //         '$cleanedStats[7]',
    //         '$cleanedStats[8]',
    //         $cleanedStats[9],
    //         $cleanedStats[10],
    //         $cleanedStats[11],
    //         $cleanedStats[12],
    //         $cleanedStats[13],
    //         $cleanedStats[14],
    //         $cleanedStats[15]
    //     )");
    // }
    $connection = null;
?>