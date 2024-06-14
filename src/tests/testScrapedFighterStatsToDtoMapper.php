<?php
    require '../../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Mapper;
    use Rjpinks\UfcScraper\Dto\FighterStatsDto;

    $mapper = new Mapper();

    function dtoComparer(FighterStatsDto $test, FighterStatsDto $expected): bool
    {
        $allTrue = true;
        if ($test->firstName != $expected->firstName) {
            $allTrue = false;
            echo "firstName does not match\n";
        }
        if ($test->lastName != $expected->lastName) {
            $allTrue = false;
            echo "lastName does not match\n";
        }
        if ($test->record != $expected->record) {
            $allTrue = false;
            echo "record does not match\n";
        }
        if ($test->height != $expected->height) {
            $allTrue = false;
            echo "height does not match\n";
        }
        if ($test->weight != $expected->weight) {
            $allTrue = false;
            echo "weight does not match\n";
        }
        if ($test->reach != $expected->reach) {
            $allTrue = false;
            echo "reach does not match\n";
        }
        if ($test->stance != $expected->stance) {
            $allTrue = false;
            echo "stance does not match\n";
        }
        if ($test->birthdate != $expected->birthdate) {
            $allTrue = false;
            echo $test->birthdate . " --- " . $expected->birthdate . PHP_EOL;
            echo "birthdate does not match\n";
        }
        if ($test->strikesPerMin != $expected->strikesPerMin) {
            $allTrue = false;
            echo "strikesPerMin does not match\n";
        }
        if ($test->strikeAccuracy != $expected->strikeAccuracy) {
            $allTrue = false;
            echo "strikeAccuracy does not match\n";
        }
        if ($test->strikesAbsorbed != $expected->strikesAbsorbed) {
            $allTrue = false;
            echo "strikesAbsorbed does not match\n";
        }
        if ($test->strikeDefence != $expected->strikeDefence) {
            $allTrue = false;
            echo "strikeDefence does not match\n";
        }
        if ($test->takedowns != $expected->takedowns) {
            $allTrue = false;
            echo "takedowns does not match\n";
        }
        if ($test->takedownAccuracy != $expected->takedownAccuracy) {
            $allTrue = false;
            echo "takedownAccuracy does not match\n";
        }
        if ($test->takedownDefence != $expected->takedownDefence) {
            $allTrue = false;
            echo "takedownDefence does not match\n";
        }
        if ($test->submissionAttempts != $expected->submissionAttempts) {
            $allTrue = false;
            echo "submissionAttempts does not match\n";
        }

        return $allTrue;
    }

    $test1 = $mapper->scrapedFighterStatsToDtoMapper([
        // url: http://ufcstats.com/fighter-details/029eaff01e6bb8f0
        "Height:" => "5' 9\"",
        "Weight:" => "155 lbs.",
        "Reach:" => "72\"",
        "STANCE:" => "Southpaw",
        "DOB:" => "Jan 19, 1989",
        "SLpM:" => "5.30",
        "Str. Acc.:" => "50%",
        "SApM:" => "4.33",
        "Str. Def:" => "52%",
        "TD Avg.:" => "1.24",
        "TD Acc.:" => "36%",
        "TD Def.:" => "64%",
        "Sub. Avg.:" => "1.3",
        "fullName" => "Dustin Poirier",
        "record" => "Record: 30-9-0 (1 NC)",
    ]);
    $test2 = $mapper->scrapedFighterStatsToDtoMapper([
        // url: http://ufcstats.com/fighter-details/f4c49976c75c5ab2
        "Height:" => "5' 9\"",
        "Weight:" => "155 lbs.",
        "Reach:" => "74\"",
        "STANCE:" => "Southpaw",
        "DOB:" => "Jul 14, 1988",
        "SLpM:" => "5.32",
        "Str. Acc.:" => "49%",
        "SApM:" => "4.66",
        "Str. Def:" => "54%",
        "TD Avg.:" => "0.67",
        "TD Acc.:" => "55%",
        "TD Def.:" => "66%",
        "Sub. Avg.:" => "0.1",
        "fullName" => "Conor McGregor",
        "record" => "Record: 22-6-0",
    ]);
    $test3 = $mapper->scrapedFighterStatsToDtoMapper([
        // url: http://ufcstats.com/fighter-details/032cc3922d871c7f
        "Height:" => "5' 10\"",
        "Weight:" => "155 lbs.",
        "Reach:" => "70\"",
        "STANCE:" => "Orthodox",
        "DOB:" => "Sep 20, 1988",
        "SLpM:" => "4.10",
        "Str. Acc.:" => "48%",
        "SApM:" => "1.75",
        "Str. Def:" => "65%",
        "TD Avg.:" => "5.32",
        "TD Acc.:" => "48%",
        "TD Def.:" => "84%",
        "Sub. Avg.:" => "0.8",
        "fullName" => "Khabib Nurmagomedov",
        "record" => "Record: 29-0-0",
    ]);
    $test4 = $mapper->scrapedFighterStatsToDtoMapper([
        // url: http://ufcstats.com/fighter-details/88be62d6c1e6dadb
        "Height:" => "--",
        "Weight:" => "125 lbs.",
        "Reach:" => "--",
        "DOB:" => "Dec 31, 2000",
        "SLpM:" => "0.00",
        "Str. Acc.:" => "0%",
        "SApM:" => "0.00",
        "Str. Def:" => "0%",
        "TD Avg.:" => "0.00",
        "TD Acc.:" => "0%",
        "TD Def.:" => "0%",
        "Sub. Avg.:" => "0.0",
        "fullName" => "Jose Ochoa",
        "record" => "Record: 7-0-0",
    ]);
    $test5 = $mapper->scrapedFighterStatsToDtoMapper([
        // url: http://ufcstats.com/fighter-details/b361180739bed4b0
        "Height:" => "6' 0\"",
        "Weight:" => "265 lbs.",
        "Reach:" => "--",
        "STANCE:" => "Switch",
        "DOB:" => "--",
        "SLpM:" => "1.35",
        "Str. Acc.:" => "30%",
        "SApM:" => "3.55",
        "Str. Def:" => "38%",
        "TD Avg.:" => "1.07",
        "TD Acc.:" => "33%",
        "TD Def.:" => "66%",
        "Sub. Avg.:" => "0.0",
        "fullName" => "David Abbott",
        "record" => "Record: 10-15-0",
    ]);

    $expected1 = new FighterStatsDto(
        "Dustin", "Poirier", "30-9-0 (1 NC)", "69", "155", "72", "Southpaw",
        "1989-01-19 00:00:00.000", "5.30", "0.5", "4.33", "0.52",
        "1.24", ".36", ".64", "1.3"
    );
    $expected2 = new FighterStatsDto(
        "Conor", "McGregor", "22-6-0", "69", "155", "74", "Southpaw",
        "1988-07-14 00:00:00.000", "5.32", "0.49", "4.66", ".54",
        ".67", ".55", ".66", ".1"
    );
    $expected3 = new FighterStatsDto(
        "Khabib", "Nurmagomedov", "29-0-0", "70", "155", "70", "Orthodox",
        "1988-09-20 00:00:00.000", "4.1", ".48", "1.75", ".65",
        "5.32", ".48", ".84", "0.8"
    );
    $expected4 = new FighterStatsDto(
        "Jose", "Ochoa", "7-0-0", "0", "125", "0", "N/A",
        "2000-12-31 00:00:00.000", "0.0", "0.0", "0.0", "0.0",
        "0.0", "0.0", "0.0", "0.0",
    );
    $expected5 = new FighterStatsDto(
        "David", "Abbott", "10-15-0", "72", "265", "0", "Switch",
        "0000-00-00 00:00:00.000", "1.35", ".3", "3.55", ".38",
        "1.07", ".33", ".66", "0.0"
    );

    if (dtoComparer($test1, $expected1)) {
        echo "Test 1 Passed\n";
    } else {
        echo "Test 1 Failed\n";
    }

    if (dtoComparer($test2, $expected2)) {
        echo "Test 2 Passed\n";
    } else {
        echo "Test 2 Failed\n";
    }

    if (dtoComparer($test3, $expected3)) {
        echo "Test 3 Passed\n";
    } else {
        echo "Test 3 Failed\n";
    }

    if (dtoComparer($test4, $expected4)) {
        echo "Test 4 Passed\n";
    } else {
        echo "Test 4 Failed\n";
    }
    if (dtoComparer($test5, $expected5)) {
        echo "Test 5 Passed\n";
    } else {
        echo "Test 5 Failed\n";
    }
?>