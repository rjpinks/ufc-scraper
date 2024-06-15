<?php
    namespace Rjpinks\UfcScraper\Scrapers;

    use Rjpinks\UfcScraper\Dto\FightStatsDto;
    use Rjpinks\UfcScraper\Dto\EventDataDto;
    use Rjpinks\UfcScraper\Dto\FighterStatsDto;
    use Rjpinks\UfcScraper\ConnectionClasses\SQLiteConnection;

    class Mapper
    {
        public function __construct()
        {

        }

        // SQLite wants a YYYY-MMM-DD HH:MM:SS.SSS structure instead of Jan 01, 1111
        private function birthdayConverter(String $date): String
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
            [$month, $day, $year] = explode(" ", $date, 3);
            return $year . $monthMap[$month] . substr($day, 0, 2) . " 00:00:00.000";
        }

        private function eventDateConverter(String $date): String
        {
            $monthMap = [
                "January" => "-01-",
                "February" => "-02-",
                "March" => "-03-",
                "April" => "-04-",
                "May" => "-05-",
                "June" => "-06-",
                "July" => "-07-",
                "August" => "-08-",
                "September" => "-09-",
                "October" => "-10-",
                "November" => "-11-",
                "December" => "-12-",
            ];
            [$month, $day, $year] = explode(" ", $date, 3);
            return $year . $monthMap[$month] . substr($day, 0, 2) . " 00:00:00.000";
        }

        private function feetToInches(String $feet): String
        {
            $feetExploded = explode(" ", $feet);
            $inches = intval($feetExploded[0]) * 12 + intval($feetExploded[1]);
            return "" . $inches;
        }

        private function queryFighterId(String $fullName): int
        {
            [$first, $last] = explode(" ", $fullName, 2);
            $pdo = new SQLiteConnection();
            $connection = $pdo->connect();

            $statement = $connection->prepare("SELECT id FROM fighter WHERE last_name = :last AND first_name = :first");
            $statement->bindParam(":last", $last);
            $statement->bindParam(":first", $first);
            $statement->execute();
            $results = $statement->fetchAll();
            if (!$results) {
                $connection = null;
                Throw new \Exception("failed to get a query");
            }
            $connection = null;
            return $results[0]["id"];
        }

        // clean the scraped fighter stat data and convert it into a defined object
        public function scrapedFighterStatsToDtoMapper(Array $scrapedData): FighterStatsDto
        {
            

            $explodedName = explode(" ", $scrapedData["fullName"], 2);

            $firstName = $explodedName[0];
            $lastName = $explodedName[1];
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

        // this will get passed the an entire scrapeEventStats array from the stack
        public function scrapedEventsToEventDataDtoMapper(Array $scrapedData): EventDataDto
        {
            return new EventDataDto(
                $scrapedData["event"],
                $this->eventDateConverter($scrapedData["date"]),
                $scrapedData["location"]
            );
        }

        // this will get passed ONLY the row keys from scrapeEventStats array
        public function scrapedEventsToFightStatsDtoMapper(Array $scrapedRow, int $eventId): FightStatsDto
        {
            $fighterOneId = "" . $this->queryFighterId($scrapedRow["fighterOne"]);
            $fighterTwoId = "" . $this->queryFighterId($scrapedRow["fighterTwo"]);
            $winnerId = !$scrapedRow["noContest"] ? $fighterOneId : "null";

            return new FightStatsDto(
                "" . $eventId,
                $fighterOneId,
                $fighterTwoId,
                $winnerId,
                $scrapedRow["fighterOneKd"],
                $scrapedRow["fighterOneStr"],
                $scrapedRow["fighterOneTd"],
                $scrapedRow["fighterOneSub"],
                $scrapedRow["fighterTwoKd"],
                $scrapedRow["fighterTwoStr"],
                $scrapedRow["fighterTwoTd"],
                $scrapedRow["fighterTwoSub"],
                $scrapedRow["weightClass"],
                $scrapedRow["method"],
                $scrapedRow["round"],
                $scrapedRow["finalTime"]
            );
        }
    }
?>