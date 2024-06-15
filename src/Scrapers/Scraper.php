<?php
    namespace Rjpinks\UfcScraper\Scrapers;


    use Symfony\Component\BrowserKit\HttpBrowser;
    use Symfony\Component\HttpClient\HttpClient;
    use Symfony\Component\CssSelector\CssSelectorConverter;

    class Scraper
    {
        private HttpBrowser $browser;
        private CssSelectorConverter $converter;

        public function __construct()
        {
            $this->browser = new HttpBrowser(HttpClient::create());
            $this->converter = new CssSelectorConverter();
        }

        public function scrapeFighterUrls(String $url): Array /* $urlStack */
        {
            // obtain HTML, convert to XML, and use XPath (from CssConverter) to find the important HTML elements.
            $this->browser->request('GET', $url);
            $content = $this->browser->getResponse()->getContent();

            libxml_use_internal_errors(true);

            $doc = new \DOMDocument();
            $doc->loadHTML($content);
            $xmlDocument = new \DOMXPath($doc);
            $xPathExpression = $this->converter->toXPath("tr > td > a");
            $tableRows = $xmlDocument->evaluate($xPathExpression);

            // clean the data
            $fighterUrls = [];
            foreach ($tableRows as $row) {
                $fighterUrls[] = $row->getAttribute("href");
            }
            return array_unique($fighterUrls);
        }

        // urls should be the result of scrapeFighterUrls
        public function scrapeFighterStats(String $url): Array /* $fighterStatsStack */
        {
            $this->browser->request("GET", $url);
            $content = $this->browser->getResponse()->getContent();

            libxml_use_internal_errors(true);
    
            $doc = new \DOMDocument();
            $doc->loadHTML($content);
            $xmlDocument = new \DOMXPath($doc);
            $xPathExpression = $this->converter->toXPath("div > ul > li");
            $listItems = $xmlDocument->evaluate($xPathExpression);

            // clean the data
            $fighterStatsMap = [];
            foreach ($listItems as $li) {
                $nestedElText = null;
                if ($li->getElementsByTagName("i")->item(0)) {
                    $nestedElText = $li->getElementsByTagName("i")->item(0)->textContent;
                } else {
                    continue;
                }
                    
                $liText = null;
                if ($li->textContent) {
                    $liText = $li->textContent;
                } else {
                    continue;
                }
                $nestedElText = trim($nestedElText);
                $liText = str_replace($nestedElText, '', $liText);
                $liText = trim($liText);

                if ($liText && $nestedElText) {
                    $fighterStatsMap[$nestedElText] = $liText;
                }
            }

            // add fighter name and record
            $xPathExpression = $this->converter->toXPath("h2 > span");
            $spanElements = $xmlDocument->evaluate($xPathExpression);
            if ($spanElements[0]->textContent) {
                $fighterStatsMap["fullName"] = trim($spanElements[0]->textContent);
            } else {
                echo "There's a problem with spanElement[0]";
            }
            if ($spanElements[1]->textContent) {
                $fighterStatsMap["record"] = trim($spanElements[1]->textContent);
            } else {
                echo "There's a problem with spanElement[1]";
            }

            $masterStats = $fighterStatsMap;
            
            return $masterStats;
        }

        public function scrapeEventUrls(String $url): Array /* $urlsStack */
        {
            $this->browser->request("GET", $url);
            $content = $this->browser->getResponse()->getContent();

            libxml_use_internal_errors(true);
    
            $doc = new \DOMDocument();
            $doc->loadHTML($content);
            $xmlDocument = new \DOMXPath($doc);
            $xPathExpression = $this->converter->toXPath("td > i > a");
            $anchorElements = $xmlDocument->evaluate($xPathExpression);

            // clean the data
            $eventUrls = [];
            foreach ($anchorElements as $anchor) {
                $eventUrls[] = $anchor->getAttribute("href");
            }
            return array_unique($eventUrls);
        }

        // urls should be the result of scrapeEventUrls
        public function scrapeEventStats(Array $urlsStack): Array /* $eventStatsStack */
        {
            $eventStackStack = [];
            while ($urlsStack) {
                $url = array_pop($urlsStack);
                $this->browser->request("GET", $url);
                $content = $this->browser->getResponse()->getContent();

                libxml_use_internal_errors(true);
    
                $doc = new \DOMDocument();
                $doc->loadHTML($content);
                $xmlDocument = new \DOMXPath($doc);

                $pageStats = [];

                // scrape the event's name off of the top of the page
                $xPathExpression = $this->converter->toXPath(".b-content__title-highlight");
                $header = $xmlDocument->evaluate($xPathExpression);
                if ($header->length > 0) {
                    $pageStats["event"] = trim($header[0]->textContent);
                } else {
                    Throw new \Exception("Event scraping has failed");
                }

                // scrape the date and location off of the top of the page
                $xPathExpression = $this->converter->toXPath(".b-list__box-list");
                $subheader = $xmlDocument->evaluate($xPathExpression);
                if ($subheader->length > 0 && $subheader[0]->getElementsbyTagName("li")->length > 0) {
                    $subheaderChildren = $subheader[0]->getElementsbyTagName("li");

                    $explodedDate = explode(" ", trim($subheaderChildren->item(0)->textContent));
                    array_shift($explodedDate);
                    $pageStats["date"] = trim(implode(" ", $explodedDate));

                    $explodedLocation = explode(" ", trim($subheaderChildren->item(1)->textContent));
                    array_shift($explodedLocation);
                    $pageStats["location"] = trim(implode(" ", $explodedLocation));
                } else if ($subheader->length > 0) {
                    Throw new \Exception(".b-list__box-list did not have any p element children");
                } else {
                    Throw new \Exception("the subheader was not found");
                }

                // scrape the data off of the table element
                $xPathExpression = $this->converter->toXPath("tbody > tr");
                $tableRows = $xmlDocument->evaluate($xPathExpression);
                $i = 1;
                foreach ($tableRows as $row) {
                    $rowData = [];
                    $tableColumns = $row->getElementsByTagName("td");
                    
                    if ($tableColumns->length == 10) {
                        $columnOne = $tableColumns->item(0);
                        $columnOneChildren = $columnOne->getElementsByTagName("p");
                        $rowData["noContest"] = $columnOneChildren->length == 2 ? true : false;

                        $columnTwo = $tableColumns->item(1);
                        $columnTwoChildren = $columnTwo->getElementsByTagName("p");
                        $rowData["fighterOne"] = trim($columnTwoChildren->item(0)->textContent);
                        $rowData["fighterTwo"] = trim($columnTwoChildren->item(1)->textContent);

                        $columnThree = $tableColumns->item(2);
                        $columnThreeChildren = $columnThree->getElementsByTagName("p");
                        $rowData["fighterOneKd"] = trim($columnThreeChildren->item(0)->textContent);
                        $rowData["fighterTwoKd"] = trim($columnThreeChildren->item(1)->textContent);

                        $columnFour = $tableColumns->item(3);
                        $columnFourChildren = $columnFour->getElementsByTagName("p");
                        $rowData["fighterOneStr"] = trim($columnFourChildren->item(0)->textContent);
                        $rowData["fighterTwoStr"] = trim($columnFourChildren->item(1)->textContent);

                        $columnfive = $tableColumns->item(4);
                        $columnfiveChildren = $columnfive->getElementsByTagName("p");
                        $rowData["fighterOneTd"] = trim($columnfiveChildren->item(0)->textContent);
                        $rowData["fighterTwoTd"] = trim($columnfiveChildren->item(1)->textContent);

                        $columnSix = $tableColumns->item(5);
                        $columnSixChildren = $columnSix->getElementsByTagName("p");
                        $rowData["fighterOneSub"] = trim($columnSixChildren->item(0)->textContent);
                        $rowData["fighterTwoSub"] = trim($columnSixChildren->item(1)->textContent);

                        $columnSeven = $tableColumns->item(6);
                        $columnSevenChildren = $columnSeven->getElementsByTagName("p");
                        $rowData["weightClass"] = trim($columnSevenChildren->item(0)->textContent);

                        $columnEight = $tableColumns->item(7);
                        $columnEightChildren = $columnEight->getElementsByTagName("p");
                        if (trim($columnEightChildren->item(1)->textContent) != "") {
                            $rowData["method"] = trim($columnEightChildren->item(0)->textContent) . " " . trim($columnEightChildren->item(1)->textContent);
                        } else {
                            $rowData["method"] = trim($columnEightChildren->item(0)->textContent);
                        }

                        $columnNine = $tableColumns->item(8);
                        $columnNineChildren = $columnNine->getElementsByTagName("p");
                        $rowData["round"] = trim($columnNineChildren->item(0)->textContent);

                        $columnTen = $tableColumns->item(9);
                        $columnTenChildren = $columnTen->getElementsByTagName("p");
                        $rowData["finalTime"] = trim($columnTenChildren->item(0)->textContent);

                        $pageStats["row$i"] = $rowData;
                        $i++;
                    } else {
                        Throw new \Exception("there was not 10 table rows");
                    }
                }
                $eventStackStack[] = $pageStats;
                sleep(1);
            }
            return $eventStackStack;
        }
    }
?>