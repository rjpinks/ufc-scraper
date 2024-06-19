<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Scrapers\Mapper;
    use Rjpinks\UfcScraper\Dto\FightStatsDto;

    /*
    This mapper queries the database using the names taken from the fight to find the fighter's ID number.
    This is the main purpose for the src/db/testingSeeds.php file.
    */

    function testScrapedEventsToFightStatsDtoMapper(FightStatsDto $test, FightStatsDto $expected): bool
    {
        $passing = true;
        if ($test->eventId != $expected->eventId) {
            $passing = false;
            echo "eventId doesn't match test: $test->eventId expected: $expected->eventId\n";
        }
        if ($test->fighterOneId != $expected->fighterOneId) {
            $passing = false;
            echo "fighterOneId doesn't match test: $test->fighterOneId expected: $expected->fighterOneId\n";
        }
        if ($test->fighterTwoId != $expected->fighterTwoId) {
            $passing = false;
            echo "fighterTwoId doesn't match test: $test->fighterTwoId expected: $expected->fighterTwoId\n";
        }
        if ($test->winnerId != $expected->winnerId) {
            $passing = false;
            echo "winnerId doesn't match test: $test->winnerId expected: $expected->winnerId\n";
        }
        if ($test->fighterOneKd != $expected->fighterOneKd) {
            $passing = false;
            echo "fighterOneKd doesn't match test: $test->fighterOneKd expected: $expected->fighterOneKd\n";
        }
        if ($test->fighterOneStrikes != $expected->fighterOneStrikes) {
            $passing = false;
            echo "fighterOneStrikes doesn't match test: $test->fighterOneStrikes expected: $expected->fighterOneStrikes\n";
        }
        if ($test->fighterOneTd != $expected->fighterOneTd) {
            $passing = false;
            echo "fighterOneTd doesn't match test: $test->fighterOneTd expected: $expected->fighterOneTd\n";
        }
        if ($test->fighterOneSubs != $expected->fighterOneSubs) {
            $passing = false;
            echo "fighterOneSubs doesn't match test: $test->fighterOneSubs expected: $expected->fighterOneSubs\n";
        }
        if ($test->fighterTwoKd != $expected->fighterTwoKd) {
            $passing = false;
            echo "fighterTwoKd doesn't match test: $test->fighterTwoKd expected: $expected->fighterTwoKd\n";
        }
        if ($test->fighterTwoStrikes != $expected->fighterTwoStrikes) {
            $passing = false;
            echo "fighterTwoStrikes doesn't match test: $test->fighterTwoStrikes expected: $expected->fighterTwoStrikes\n";
        }
        if ($test->fighterTwoTd != $expected->fighterTwoTd) {
            $passing = false;
            echo "fighterTwoTd doesn't match test: $test->fighterTwoTd expected: $expected->fighterTwoTd\n";
        }
        if ($test->fighterTwoSubs != $expected->fighterTwoSubs) {
            $passing = false;
            echo "fighterTwoSubs doesn't match test: $test->fighterTwoSubs expected: $expected->fighterTwoSubs\n";
        }
        if ($test->weightClass != $expected->weightClass) {
            $passing = false;
            echo "weightClass doesn't match test: $test->weightClass expected: $expected->weightClass\n";
        }
        if ($test->method != $expected->method) {
            $passing = false;
            echo "method doesn't match test: $test->method expected: $expected->method\n";
        }
        if ($test->lastRound != $expected->lastRound) {
            $passing = false;
            echo "lastRound doesn't match test: $test->lastRound expected: $expected->lastRound\n";
        }
        if ($test->finalTime != $expected->finalTime) {
            $passing = false;
            echo "finalTime doesn't match test: $test->finalTime expected: $expected->finalTime\n";
        }
        return $passing;
    }

    $scraper = new Scraper();
    $mapper = new Mapper();

    $results = $scraper->scrapeEventStats("http://ufcstats.com/event-details/cba3a2dfbc06ce79");
    
    print_r($results);

    $data = $results;

    $tests = [];
    $expected = [
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
        ),
    ];
    
    $i = 1;
    while ($i < 6) {
        $tests[] = $mapper->scrapedEventsToFightStatsDtoMapper($data["row$i"], 1);
        $i++;
    }
    for ($i = 0; $i < count($tests); $i++) {
        $testNumber = $i + 1;
        echo testScrapedEventsToFightStatsDtoMapper($tests[$i], $expected[$i]) ? "test $testNumber passed\n" : "test $testNumber failed see above\n";
    }
?>