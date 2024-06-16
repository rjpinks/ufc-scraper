<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Scrapers\Mapper;
    use Rjpinks\UfcScraper\Dto\FighterStatsDto;


    // While running, I encountered a fighter that only has a last name, which I did not anticipate
    $scraper = new Scraper();
    $mapper = new Mapper();

    $results = $scraper->scrapeFighterStats("http://ufcstats.com/fighter-details/3f11fd1751fa83b1");
    $yizhaStatsDto = $mapper->scrapedFighterStatsToDtoMapper($results);

    $expected = new FighterStatsDto(
        "N/A",
        "Yizha",
        "25-4-0",
        "67",
        "145",
        "71",
        "Orthodox",
        "1997-01-08 00:00:00.000",
        "2.82",
        ".44",
        "2.20",
        ".54",
        "4.55",
        ".32",
        ".59",
        "1.4"
    );

    $passing = true;
    if ($yizhaStatsDto->firstName != $expected->firstName) {
        $passing = false;
        echo "firstName doesn't match\n";
    }
    if ($yizhaStatsDto->lastName != $expected->lastName) {
        $passing = false;
        echo "lastName doesn't match\n";
    }
    if ($yizhaStatsDto->record != $expected->record) {
        $passing = false;
        echo "record doesn't match\n";
    }
    if ($yizhaStatsDto->height != $expected->height) {
        $passing = false;
        echo "height doesn't match\n";
    }
    if ($yizhaStatsDto->weight != $expected->weight) {
        $passing = false;
        echo "weight doesn't match\n";
    }
    if ($yizhaStatsDto->reach != $expected->reach) {
        $passing = false;
        echo "reach doesn't match\n";
    }
    if ($yizhaStatsDto->stance != $expected->stance) {
        $passing = false;
        echo "stance doesn't match\n";
    }
    if ($yizhaStatsDto->birthdate != $expected->birthdate) {
        $passing = false;
        echo "birthdate doesn't match\n";
    }
    if ($yizhaStatsDto->strikesPerMin != $expected->strikesPerMin) {
        $passing = false;
        echo "strikesPerMin doesn't match\n";
    }
    if ($yizhaStatsDto->strikeAccuracy != $expected->strikeAccuracy) {
        $passing = false;
        echo "strikeAccuracy doesn't match\n";
    }
    if ($yizhaStatsDto->strikesAbsorbed != $expected->strikesAbsorbed) {
        $passing = false;
        echo "strikesAbsorbed doesn't match\n";
    }
    if ($yizhaStatsDto->strikeDefence != $expected->strikeDefence) {
        $passing = false;
        echo "strikeDefence doesn't match\n";
    }
    if ($yizhaStatsDto->takedowns != $expected->takedowns) {
        $passing = false;
        echo "takedowns doesn't match\n";
    }
    if ($yizhaStatsDto->takedownAccuracy != $expected->takedownAccuracy) {
        $passing = false;
        echo "takedownAccuracy doesn't match\n";
    }
    if ($yizhaStatsDto->takedownDefence != $expected->takedownDefence) {
        $passing = false;
        echo "takedownDefence doesn't match\n";
    }
    if ($yizhaStatsDto->submissionAttempts != $expected->submissionAttempts) {
        $passing = false;
        echo "submissionAttempts doesn't match\n";
    }
    echo $passing ? "Yizha fighter stats test passed\n" : "!!!YIZHA TEST FAILED!!!\n";

    /* 
    I am anticipating problems with fighters lacking a first name with indivisual fights.
    I already altered Mapper::queryFighterId, so I'm going to test it with a Yizha fight.
    */
?>