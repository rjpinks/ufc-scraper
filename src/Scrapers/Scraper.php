<?php
    namespace Rjpinks\UfcScraper\Scrapers;

    use Symfony\Component\BrowserKit\HttpBrowser;
    use Symfony\Component\HttpClient\HttpClient;
    use Symfony\Component\CssSelector\CssSelectorConverter;

    class Scraper {
        private $browser;
        private $converter;

        public function __construct()
        {
            $this->browser = new HttpBrowser(HttpClient::create());
            $this->converter = new CssSelectorConverter();
        }

        /**
         * @param String $url
         * @return String[]
         */
        public function scrapeFighterUrls($url)
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

        /**
         * @param String[]
         * @return Array[]
         */
        public function scrapeFighterStats($urls)
        {
            $masterStats = [];
            foreach ($urls as $url) {
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
                        // echo "Skipped one nestedElText\n";
                        continue;
                    }
                    
                    $liText = null;
                    if ($li->textContent) {
                        $liText = $li->textContent;
                    } else {
                        // echo "Skipped one liText\n";
                        continue;
                    }
                    $nestedElText = trim($nestedElText);
                    $liText = str_replace($nestedElText, '', $liText);
                    $liText = trim($liText);

                    if ($liText && $nestedElText) {
                        $fighterStatsMap[$nestedElText] = $liText;
                    } 
                    // else {
                    //     echo "Something went wrong my dude!\n";
                    // }
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

                $masterStats[] = $fighterStatsMap;
                }
            return $masterStats;
        }
    }
?>