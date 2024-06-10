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
            $inches += intval($explodedFeet[1]);
            return $inches;
        }

        /**
         * @param String $bday
         * @return String
         */
        private function birthdayFormatter($bday)
        {
            $explodedBday = explode(" ", $bday, 3);
            $formattedBday = $explodedBday[2];
            switch ($explodedBday[0]) {
                case "Jan":
                    $formattedBday .= "-01-";
                    break;
                case "Feb":
                    $formattedBday .= "-02-";
                    break;
                case "Mar":
                    $formattedBday .= "-03-";
                    break;
                case "Apr":
                    $formattedBday .= "-04-";
                    break;
                case "May":
                    $formattedBday .= "-05-";
                    break;
                case "Jun":
                    $formattedBday .= "-06-";
                    break;
                case "Jul":
                    $formattedBday .= "-07-";
                    break;
                case "Aug":
                    $formattedBday .= "-08-";
                    break;
                case "Sep":
                    $formattedBday .= "-09-";
                    break;
                case "Oct":
                    $formattedBday .= "-10-";
                    break;
                case "Nov":
                    $formattedBday .= "-11-";
                    break;
                case "Dec":
                    $formattedBday .= "-12-";
            }
            $formattedBday .= substr($explodedBday[1], 0, strlen($explodedBday[1]) - 1);
            return $formattedBday;
        }

        /**
         * @param String $record
         * @return String
         */
        private function recordFormatter($record)
        {
            $i = 0;
            while ($record[$i] != " " && $i < strlen($record)) {
                $i++;
            }
            return substr($record, $i + 1);
        }

        /**
         * @param String $weight
         * @return int
         */
        private function weightFormatter($weight)
        {
            $explodedWeight = explode(" ", $weight, 1);
            return intval($explodedWeight[0]);
        }

        /**
         * Use this method to clean the scraped data for sql insertion
         * @param String[] $scrapedDict
         * @return List
         */
        public function fighterStatsToSql($scrapedDict)
        {
            $sqlList = [];

            $explodedName = explode(" ", $scrapedDict["fullName"]);
            $sqlList[] = $explodedName[0];
            $sqlList[] = $explodedName[count($explodedName) - 1]; /* idk how some of the brazilian names will be handled */
            $sqlList[] = $this->recordFormatter($scrapedDict["record"]);
            $sqlList[] = $scrapedDict["Height:"] == "--" ? 0 : $this->heightToInches($scrapedDict["Height:"]);
            $sqlList[] = $scrapedDict["Weight:"] == "--" ? 0 : $this->weightFormatter($scrapedDict["Weight:"]);
            $sqlList[] = $scrapedDict["Reach:"] == "--" ? 0 : intval(substr($scrapedDict["Reach:"], 0, strlen($scrapedDict["Reach:"]) - 1));
            $sqlList[] = key_exists("STANCE:", $scrapedDict) ? $scrapedDict["STANCE:"] : "--";
            $sqlList[] = $scrapedDict["DOB:"] != "--" ? $this->birthdayFormatter($scrapedDict["DOB:"]) : "--";
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