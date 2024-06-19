<?php
    require '../../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Mapper;
    use Rjpinks\UfcScraper\Scrapers\Scraper;
    use Rjpinks\UfcScraper\Dto\EventDataDto;

    function testScrapedEventsToEventDataDtoMapper(EventDataDto $test, EventDataDto $expected): bool
    {
        $passing = true;
        if ($test->eventName != $expected->eventName) {
            $passing = false;
            echo "eventName did not match. tested: $test->eventName expected: $expected->eventName\n";
        }
        if ($test->dateOccurred != $expected->dateOccurred) {
            $passing = false;
            echo "dateOccurred did not match. tested: $test->dateOccurred expected: $expected->dateOccurred\n";
        }
        if ($test->eventLocation != $expected->eventLocation) {
            $passing = false;
            echo "eventLocation did not match. tested: $test->eventLocation expected: $expected->eventLocation\n";
        }
        return $passing;
    }

    $scraper = new Scraper();
    
    $results = [];
    $urls = [
        "http://ufcstats.com/event-details/cba3a2dfbc06ce79",
        "http://ufcstats.com/event-details/a6a9ab5a824e8f66",
        "http://ufcstats.com/event-details/279093302a6f44b3",
        "http://ufcstats.com/event-details/2a542ee8a8b83559",
        "http://ufcstats.com/event-details/f9aa6376ae16bfb4"
    ];
    foreach ($urls as $url) {
        $results[] = $scraper->scrapeEventStats($url);
    }
    $mapper = new Mapper();
    $test1 = $mapper->scrapedEventsToEventDataDtoMapper($results[0]);
    $test2 = $mapper->scrapedEventsToEventDataDtoMapper($results[1]);
    $test3 = $mapper->scrapedEventsToEventDataDtoMapper($results[2]);
    $test4 = $mapper->scrapedEventsToEventDataDtoMapper($results[3]);
    $test5 = $mapper->scrapedEventsToEventDataDtoMapper($results[4]);

    $expected1 = new EventDataDto(
        "UFC Fight Night: Cannonier vs. Imavov",
        "2024-06-08 00:00:00.000",
        "Louisville, Kentucky, USA"
    );
    $expected2 = new EventDataDto(
        "UFC 2: No Way Out",
        "1994-03-11 00:00:00.000",
        "Denver, Colorado, USA",
    );
    $expected3 = new EventDataDto(
        "UFC Fight Night: Diaz vs Neer",
        "2008-09-17 00:00:00.000",
        "Omaha, Nebraska, USA",
    );
    $expected4 = new EventDataDto(
        "UFC 94: St-Pierre vs Penn 2",
        "2009-01-31 00:00:00.000",
        "Las Vegas, Nevada, USA",
    );
    $expected5 = new EventDataDto(
        "UFC Fight Night: McGregor vs Siver",
        "2015-01-18 00:00:00.000",
        "Boston, Massachusetts, USA",
    );

    echo testScrapedEventsToEventDataDtoMapper($test1, $expected1) ? "test 1 passed\n" : "test 1 failed see above\n";
    echo testScrapedEventsToEventDataDtoMapper($test2, $expected2) ? "test 2 passed\n" : "test 2 failed see above\n";
    echo testScrapedEventsToEventDataDtoMapper($test3, $expected3) ? "test 3 passed\n" : "test 3 failed see above\n";
    echo testScrapedEventsToEventDataDtoMapper($test4, $expected4) ? "test 4 passed\n" : "test 4 failed see above\n";
    echo testScrapedEventsToEventDataDtoMapper($test5, $expected5) ? "test 5 passed\n" : "test 5 failed see above\n";
?>