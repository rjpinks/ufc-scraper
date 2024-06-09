<?php
    namespace Rjpinks\UfcScraper\Scrapers;

    class Cleaner
    {
        public function __construct()
        {

        }

        /**
         * @param String $feet
         * @return int
         */
        private function heightToInches($feet)
        {
            $explodedFeet = explode(" ", $feet);
            $inches = intval($explodedFeet[0]) * 12;
            $inches += intval(substr($explodedFeet[1], 0, strlen($explodedFeet[1] - 1)));
        }

        /**
         * @param String @bday
         * @return String
         */
        private function birthdayFormatter($bday)
        {
            $explodedBday = explode(" ", $bday, 3);
            $formattedBday = $explodedBday[2];
            switch ($explodedBday[0]) {
                case "Jan":
                    $formattedBday .= "-01";
                    break;
                case "Feb":
                    $formattedBday .= "-02";
                    break;
                case "Mar":
                    $formattedBday .= "-03";
                    break;
                case "Apr":
                    $formattedBday .= "-04";
                    break;
                case "May":
                    $formattedBday .= "-05";
                    break;
                case "Jun":
                    $formattedBday .= "-06";
                    break;
                case "Jul":
                    $formattedBday .= "-07";
                    break;
                case "Aug":
                    $formattedBday .= "-08";
                    break;
                case "Sep":
                    $formattedBday .= "-09";
                    break;
                case "Oct":
                    $formattedBday .= "-10";
                    break;
                case "Nov":
                    $formattedBday .= "-11";
                    break;
                case "Dec":
                    $formattedBday .= "-12";
            }
            $formattedBday .= substr($explodedBday[1], 0, strlen($explodedBday[1] - 1));
            return $formattedBday;
        }

        /**
         * Use this method to clean the scraped data for sql insertion
         * @param Array $scrapedDict
         * @return List
         */
        public function fighterStatsToSql($scrapedDict)
        {
            $sqlList = [];

            $explodedName = explode(" ", $scrapedDict["fullName"]);
            $sqlList[] = $explodedName[0];
            $sqlList[] = $explodedName[count($explodedName) - 1]; /* idk how some of the brazilian names will be handled */
            $sqlList[] = $scrapedDict["record"];
            $sqlList[] = $this->heightToInches($scrapedDict["Height:"]);
            $sqlList[] = explode(" ", $scrapedDict["Weight:"], 1);
            $sqlList[] = intval(substr($scrapedDict["Reach:"], 0, strlen($scrapedDict["Reach:"]) - 1));
            $sqlList[] = $scrapedDict["STANCE:"];
            $sqlList[] = $this->birthdayFormatter($scrapedDict["DOB:"]);
            $sqlList[] = floatval($scrapedDict["SLpM:"]);
            $sqlList[] = intval(substr($scrapedDict["Str. Acc.:"], 0, strlen($scrapedDict["Str. Acc.:"]) - 1)) / 100;
            $sqlList[] = floatval($scrapedDict["SApM:"]);
            $sqlList[] = intval(substr($scrapedDict["Str. Def:"], 0, strlen($scrapedDict["Str. Def:"]) - 1)) / 100;
            $sqlList[] = floatval($scrapedDict["TD Avg.:"]);
            $sqlList[] = intval(substr($scrapedDict["TD Acc.:"], 0, strlen($scrapedDict["TD Acc.:"]) - 1)) / 100;
            $sqlList[] = intval(substr($scrapedDict["TD Def.:"], 0, strlen($scrapedDict["TD Def.:"]) - 1)) / 100;
            $sqlList[] = floatval($scrapedDict["Sub. Avg.:"]);

            return $sqlList;
        }
    }
?>