<?php
    require '../../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Cleaner;

    /**
     * @param Array[] $cleaned
     * @param List[] $scraped
     * @return bool
     */
    function testCleanFighterStats($expected, $scraped)
    {
        $cleaner = new Cleaner();
        return $expected == $cleaner->fighterStatsToSql($scraped);
    }

    $tests = [
        [
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
        ],
        [
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
        ],
        [
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
        ],
        [
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
        ],
        [
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
        ]
    ];

    $expected = [
        ["Dustin", "Poirier", "30-9-0 (1 NC)", 69, 155, 72, "Southpaw", "1989-01-19", 5.30, .5, 4.33, .52, 1.24, .36, .64, 1.3],
        ["Conor", "McGregor", "22-6-0", 69, 155, 74, "Southpaw", "1988-07-14", 5.32, .49, 4.66, .54, .67, .55, .66, .1],
        ["Khabib", "Nurmagomedov", "29-0-0", 70, 155, 70, "Orthodox", "1988-09-20", 4.1, .48, 1.75, .65, 5.32, .48, .84, .8],
        ["Jose", "Ochoa", "7-0-0", 0, 125, 0, "--", "2000-12-31", 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0],
        ["David", "Abbott", "10-15-0", 72, 265, 0, "Switch", "--", 1.35, .3, 3.55, .38, 1.07, .33, .66, 0.0]
    ];

    for ($i = 0; $i < count($expected); $i++) {
        if (testCleanFighterStats($expected[$i], $tests[$i])) {
            echo "true\n";
        } else {
            echo "false\n";
        }
    }

?>