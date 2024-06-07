<?php
    require '../../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Scraper;

    /**
     * @param String[] $url
     * @return Array[]
     */
    function testScrapeFighterStats($urls) {
        $scraper = new Scraper();
        return $scraper->scrapeFighterStats($urls);
    }

    // tests:
    $test1 = [
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
    ];
    $test2 = [
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
    ];
    $test3 = [
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
    ];
    $test4 = [
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
    ];
    $test5 = [
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
    ];

    if ([$test1] == testScrapeFighterStats(["http://ufcstats.com/fighter-details/029eaff01e6bb8f0"])) {
        echo "test 1 pass\n";
    } else {
        echo "!!!!!!!!!!!!!!!!!!!TEST 1 FAILED!!!!!!!!!!!!!!!!!!!!!\n";
    }

    if ([$test2] == testScrapeFighterStats(["http://ufcstats.com/fighter-details/f4c49976c75c5ab2"])) {
        echo "test 2 pass\n";
    } else {
        echo "!!!!!!!!!!!!!!!!!!!TEST 2 FAILED!!!!!!!!!!!!!!!!!!!!!\n";
    }

    if ([$test3] == testScrapeFighterStats(["http://ufcstats.com/fighter-details/032cc3922d871c7f"])) {
        echo "test 3 pass\n";
    } else {
        echo "!!!!!!!!!!!!!!!!!!!TEST 3 FAILED!!!!!!!!!!!!!!!!!!!!!\n";
    }

    if ([$test4] == testScrapeFighterStats(["http://ufcstats.com/fighter-details/88be62d6c1e6dadb"])) {
        echo "test 4 pass\n";
    } else {
        echo "!!!!!!!!!!!!!!!!!!!TEST 4 FAILED!!!!!!!!!!!!!!!!!!!!!\n";
    }

    if ([$test5] == testScrapeFighterStats(["http://ufcstats.com/fighter-details/b361180739bed4b0"])) {
        echo "test 5 pass\n";
    } else {
        echo "!!!!!!!!!!!!!!!!!!!TEST 5 FAILED!!!!!!!!!!!!!!!!!!!!!\n";
    }
?>
