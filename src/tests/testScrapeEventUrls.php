<?php
    require '../../vendor/autoload.php';

    use Rjpinks\UfcScraper\Scrapers\Scraper;

    $scraper = new Scraper();
    $scrapedUrls = $scraper->scrapeEventUrls("http://ufcstats.com/statistics/events/completed?page=all");

    // tests:
    $last = count($scrapedUrls) - 1;

    echo $scrapedUrls[0] == "http://ufcstats.com/event-details/9c5828c6fd9dc948" ? "Test 1 Passed\n" : "!!! TEST 1 FAILED !!!\n";
    echo $scrapedUrls[1] == "http://ufcstats.com/event-details/cba3a2dfbc06ce79" ? "Test 2 Passed\n" : "!!! TEST 2 FAILED !!!\n";
    echo $scrapedUrls[2] == "http://ufcstats.com/event-details/6e4acc2c115215b5" ? "Test 3 Passed\n" : "!!! TEST 3 FAILED !!!\n";
    echo $scrapedUrls[3] == "http://ufcstats.com/event-details/46baf0f57edfa4df" ? "Test 4 Passed\n" : "!!! TEST 4 FAILED !!!\n";
    echo $scrapedUrls[4] == "http://ufcstats.com/event-details/5dfe71ade71f3a4b" ? "Test 5 Passed\n" : "!!! TEST 5 FAILED !!!\n";
    echo $scrapedUrls[$last] == "http://ufcstats.com/event-details/a6a9ab5a824e8f66" ? "Test 6 Passed\n" : "!!! TEST 6 FAILED !!!\n";
?>