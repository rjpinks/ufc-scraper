<?php
    require '../vendor/autoload.php';

    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;
    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Scrapers\Cleaner;

    // Gather the URL for each of the fighter's pages.
    $urlList = [];
    $alphabet = range('a', 'z');
    $scraper = new Scraper();
    foreach ($alphabet as $char) {
        $scrapedData = $scraper->scrapeFighterUrls("http://ufcstats.com/statistics/fighters?char=" . $char . "&page=all");
        $urlList = array_merge($urlList, $scrapedData);
        sleep(1);
        echo "fighter page acquired";
    }

    // Parse the data and post into db
    $cleaner = new Cleaner();
    $pdo = new SQLiteConnection();
    $connection = $pdo->connect();

    echo "stat scraping has begun\n";

    $scrapedFighterStats = $scraper->scrapeFighterStats($urlList);

    $insertion = 0;
    try {
        $connection->beginTransaction();

        $sqlStatement = $connection->prepare(
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
                :first_name,
                :last_name,
                :record,
                :height_inches,
                :weight_in_lbs,
                :reach_inches,
                :stance,
                :birthdate,
                :strikes_landed_per_min,
                :striking_accuracy,
                :strikes_absorbed_per_min,
                :striking_defence,
                :average_takedowns_per_fifteen,
                :takedown_accuracy,
                :takedown_defence,
                :average_submissions_attempted_per_fifteen
            )"
        );

        foreach ($scrapedFighterStats as $stat) {
            $cleanedStat = $cleaner->scrapedFighterStatsToDtoMapper($stat);

            if ($cleanedStat) {
                $sqlStatement->execute([
                    ':first_name' => $cleanedStat->firstName,
                    ':last_name' => $cleanedStat->lastName,
                    ':record' => $cleanedStat->record,
                    ':height_inches' => $cleanedStat->height,
                    ':weight_in_lbs' => $cleanedStat->weight,
                    ':reach_inches' => $cleanedStat->reach,
                    ':stance' => $cleanedStat->stance,
                    ':birthdate' => $cleanedStat->birthdate,
                    ':strikes_landed_per_min' => $cleanedStat->strikesPerMin,
                    ':striking_accuracy' => $cleanedStat->strikeAccuracy,
                    ':strikes_absorbed_per_min' => $cleanedStat->strikesAbsorbed,
                    ':striking_defence' => $cleanedStat->strikeDefence,
                    ':average_takedowns_per_fifteen' => $cleanedStat->takedowns,
                    ':takedown_accuracy' => $cleanedStat->takedownAccuracy,
                    ':takedown_defence' => $cleanedStat->takedownDefence,
                    ':average_submissions_attempted_per_fifteen' => $cleanedStat->submissionAttempts,
                ]);
                echo "Entry Made\n";
            } else {
                $connection->rollBack();
                Throw new Exception("cleanedStat failed to map\n");
            }
            sleep(1);
        }
         $connection->commit();
    } catch (Exception $e) {
        $connection->rollBack();
        echo "Failed: " . $e->getMessage() . PHP_EOL;
    }

    $connection = null;
?>