<?php
    namespace Rjpinks\UfcScraper\Scrapers;

    use Rjpinks\UfcScraper\Dto\FighterStatsDto;

    class Mapper
    {
        public function __construct()
        {

        }

        private function feetToInches(String $feet): String
        {
            $feetExploded = explode(" ", $feet);
            $inches = intval($feetExploded[0]) * 12 + intval($feetExploded[1]);
            return "" . $inches;
        }

        // SQLite wants a YYYY-MMM-DD HH:MM:SS.SSS structure instead of Jan 01, 1111
        private function birthdayConverter(String $bday): String
        {
            $monthMap = [
                "Jan" => "-01-",
                "Feb" => "-02-",
                "Mar" => "-03-",
                "Apr" => "-04-",
                "May" => "-05-",
                "Jun" => "-06-",
                "Jul" => "-07-",
                "Aug" => "-08-",
                "Sep" => "-09-",
                "Oct" => "-10-",
                "Nov" => "-11-",
                "Dec" => "-12-",
            ];
            [$month, $day, $year] = explode(" ", $bday, 3);
            return $year . $monthMap[$month] . substr($day, 0, 2) . " 00:00:00.000";
        }

        // clean the scraped fighter stat data and convert it into a defined object
        public function scrapedFighterStatsToDtoMapper(Array $scrapedData): FighterStatsDto
        {
            $explodedName = explode(" ", $scrapedData["fullName"]);

            $firstName = $explodedName[0];
            $lastName = $explodedName[count($explodedName) - 1];
            $record = substr($scrapedData["record"], 8);
            $height = $scrapedData["Height:"] == "--" ? "0" : $this->feetToInches($scrapedData["Height:"]);
            $weight = trim(substr($scrapedData["Weight:"], 0, 3));
            $reach = $scrapedData["Reach:"] == "--" ? "0" : substr($scrapedData["Reach:"], 0, 2);
            $stance = key_exists("STANCE:", $scrapedData) ? $scrapedData["STANCE:"] : "N/A";
            $bday = $scrapedData["DOB:"] != "--" ? $this->birthdayConverter($scrapedData["DOB:"]) : "0000-00-00 00:00:00.000";
            $strikesPerMin = $scrapedData["SLpM:"];
            $strikingAccuracy = "" . (intval($scrapedData["Str. Acc.:"]) / 100);
            $strikesAbsorbed = $scrapedData["SApM:"];
            $strikingDefence = "" . (intval($scrapedData["Str. Def:"]) / 100);
            $takedowns = $scrapedData["TD Avg.:"];
            $takedownAccuracy = "" . (intval($scrapedData["TD Acc.:"]) / 100);
            $takedownDefence = "" . (intval($scrapedData["TD Def.:"]) / 100);
            $submissionsAttempted = $scrapedData["Sub. Avg.:"];

            return new FighterStatsDto(
                $firstName, $lastName, $record, $height, $weight, $reach, $stance, $bday,
                $strikesPerMin, $strikingAccuracy, $strikesAbsorbed, $strikingDefence,
                $takedowns, $takedownAccuracy, $takedownDefence, $submissionsAttempted
            );
        }
    }
?>