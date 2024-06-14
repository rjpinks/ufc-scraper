<?php
    require "../../vendor/autoload.php";

    use Rjpinks\UfcScraper\Scrapers\Scraper;

    function testScrapeEventStats(Array $test, Array $expected)
    {
        $criteria = [
            "event", "date", "location", "rowOneFighterTwo", "rowThreeFighterOne",
            "rowSevenFighterOneStr", "rowFiveFighterTwoKd", "rowTenWeightClass",
            "rowEightMethod", "rowTwoFinalTime"
        ];
        for ($i = 0; $i < count($criteria); $i++) {
            $key = $criteria[$i];
            if ($test[$key] != $expected[$key]) {
                echo "test" . $test[$key] . " expected" . $expected[$key] . " $key failed ";
                return false;
            }
        }
        return true;
    }
    
    $scraper = new Scraper();
    $results = null;
    $urlQueue = [
        "http://ufcstats.com/event-details/cba3a2dfbc06ce79",
        "http://ufcstats.com/event-details/a6a9ab5a824e8f66",
        "http://ufcstats.com/event-details/279093302a6f44b3",
        "http://ufcstats.com/event-details/2a542ee8a8b83559",
        "http://ufcstats.com/event-details/f9aa6376ae16bfb4"
    ];
    
    try {
        $results = $scraper->scrapeEventStats($urlQueue);
    } catch (Exception $e) {
        echo "Failed: " . $e->getMessage() . PHP_EOL;
    }
    
    $test1 = [
        "event" => $results[0]["event"],
        "date" => $results[0]["date"],
        "location" => $results[0]["location"],
        "rowOneFighterTwo" => $results[0]["row1"]["fighterTwo"],
        "rowThreeFighterOne" => $results[0]["row3"]["fighterOne"],
        "rowSevenFighterOneStr" => $results[0]["row7"]["fighterOneStr"],
        "rowFiveFighterTwoKd" => $results[0]["row5"]["fighterTwoKd"],
        "rowTenWeightClass" => $results[0]["row10"]["weightClass"],
        "rowEightMethod" => $results[0]["row8"]["method"],
        "rowTwoFinalTime" => $results[0]["row2"]["finalTime"]
    ];
    $expected1 = [
        // url => http://ufcstats.com/event-details/cba3a2dfbc06ce79
        "event" => "UFC Fight Night: Cannonier vs. Imavov",
        "date" => "June 08, 2024",
        "location" => "Louisville, Kentucky, USA",
        "rowOneFighterTwo" => "Jared Cannonier",
        "rowThreeFighterOne" => "Raul Rosas Jr.",
        "rowSevenFighterOneStr" => "56",
        "rowFiveFighterTwoKd" => "0",
        "rowTenWeightClass" => "Women's Flyweight",
        "rowEightMethod" => "KO/TKO Knee",
        "rowTwoFinalTime" => "2:00"
    ];
    $test2 = [
        "event" => $results[1]["event"],
        "date" => $results[1]["date"],
        "location" => $results[1]["location"],
        "rowOneFighterTwo" => $results[1]["row1"]["fighterTwo"],
        "rowThreeFighterOne" => $results[1]["row3"]["fighterOne"],
        "rowSevenFighterOneStr" => $results[1]["row7"]["fighterOneStr"],
        "rowFiveFighterTwoKd" => $results[1]["row5"]["fighterTwoKd"],
        "rowTenWeightClass" => $results[1]["row10"]["weightClass"],
        "rowEightMethod" => $results[1]["row8"]["method"],
        "rowTwoFinalTime" => $results[1]["row2"]["finalTime"]
    ];
    $expected2 = [
        // url => http://ufcstats.com/event-details/a6a9ab5a824e8f66
        "event" => "UFC 2: No Way Out",
        "date" => "March 11, 1994",
        "location" => "Denver, Colorado, USA",
        "rowOneFighterTwo" => "Patrick Smith",
        "rowThreeFighterOne" => "Patrick Smith",
        "rowSevenFighterOneStr" => "13",
        "rowFiveFighterTwoKd" => "0",
        "rowTenWeightClass" => "Open Weight",
        "rowEightMethod" => "SUB Armbar",
        "rowTwoFinalTime" => "1:31"
    ];
    $test3 = [
        "event" => $results[2]["event"],
        "date" => $results[2]["date"],
        "location" => $results[2]["location"],
        "rowOneFighterTwo" => $results[2]["row1"]["fighterTwo"],
        "rowThreeFighterOne" => $results[2]["row3"]["fighterOne"],
        "rowSevenFighterOneStr" => $results[2]["row7"]["fighterOneStr"],
        "rowFiveFighterTwoKd" => $results[2]["row5"]["fighterTwoKd"],
        "rowTenWeightClass" => $results[2]["row10"]["weightClass"],
        "rowEightMethod" => $results[2]["row8"]["method"],
        "rowTwoFinalTime" => $results[2]["row2"]["finalTime"]
    ];
    $expected3 = [
        // url => http://ufcstats.com/event-details/279093302a6f44b3
        "event" => "UFC Fight Night: Diaz vs Neer",
        "date" => "September 17, 2008",
        "location" => "Omaha, Nebraska, USA",
        "rowOneFighterTwo" => "Josh Neer",
        "rowThreeFighterOne" => "Alan Belcher",
        "rowSevenFighterOneStr" => "23",
        "rowFiveFighterTwoKd" => "0",
        "rowTenWeightClass" => "Middleweight",
        "rowEightMethod" => "KO/TKO Punches",
        "rowTwoFinalTime" => "5:00"
    ];
    $test4 = [
        "event" => $results[3]["event"],
        "date" => $results[3]["date"],
        "location" => $results[3]["location"],
        "rowOneFighterTwo" => $results[3]["row1"]["fighterTwo"],
        "rowThreeFighterOne" => $results[3]["row3"]["fighterOne"],
        "rowSevenFighterOneStr" => $results[3]["row7"]["fighterOneStr"],
        "rowFiveFighterTwoKd" => $results[3]["row5"]["fighterTwoKd"],
        "rowTenWeightClass" => $results[3]["row10"]["weightClass"],
        "rowEightMethod" => $results[3]["row8"]["method"],
        "rowTwoFinalTime" => $results[3]["row2"]["finalTime"]
    ];
    $expected4 = [
        // url => http://ufcstats.com/event-details/2a542ee8a8b83559
        "event" => "UFC 94: St-Pierre vs Penn 2",
        "date" => "January 31, 2009",
        "location" => "Las Vegas, Nevada, USA",
        "rowOneFighterTwo" => "BJ Penn",
        "rowThreeFighterOne" => "Jon Jones",
        "rowSevenFighterOneStr" => "27",
        "rowFiveFighterTwoKd" => "0",
        "rowTenWeightClass" => "Welterweight",
        "rowEightMethod" => "S-DEC",
        "rowTwoFinalTime" => "4:59"
    ];
    $test5 = [
        // url => "http://ufcstats.com/event-details/f9aa6376ae16bfb4"
        "event" => $results[4]["event"],
        "date" => $results[4]["date"],
        "location" => $results[4]["location"],
        "rowOneFighterTwo" => $results[4]["row1"]["fighterTwo"],
        "rowThreeFighterOne" => $results[4]["row3"]["fighterOne"],
        "rowSevenFighterOneStr" => $results[4]["row7"]["fighterOneStr"],
        "rowFiveFighterTwoKd" => $results[4]["row5"]["fighterTwoKd"],
        "rowTenWeightClass" => $results[4]["row10"]["weightClass"],
        "rowEightMethod" => $results[4]["row8"]["method"],
        "rowTwoFinalTime" => $results[4]["row2"]["finalTime"]
    ];
    $expected5 = [
        // url => http://ufcstats.com/event-details/f9aa6376ae16bfb4
        "event" => "UFC Fight Night: McGregor vs Siver",
        "date" => "January 18, 2015",
        "location" => "Boston, Massachusetts, USA",
        "rowOneFighterTwo" => "Dennis Siver",
        "rowThreeFighterOne" => "Uriah Hall",
        "rowSevenFighterOneStr" => "47",
        "rowFiveFighterTwoKd" => "1",
        "rowTenWeightClass" => "Featherweight",
        "rowEightMethod" => "U-DEC",
        "rowTwoFinalTime" => "5:00"
    ];

    echo testScrapeEventStats($test1, $expected1) ? "test 1 passed\n" : "test 1\n";
    echo testScrapeEventStats($test2, $expected2) ? "test 2 passed\n" : "test 2\n";
    echo testScrapeEventStats($test3, $expected3) ? "test 3 passed\n" : "test 3\n";
    echo testScrapeEventStats($test4, $expected4) ? "test 4 passed\n" : "test 4\n";
    echo testScrapeEventStats($test5, $expected5) ? "test 5 passed\n" : "test 5\n";
?>