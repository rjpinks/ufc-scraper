<?php
    namespace Rjpinks\UfcScraper\ConnectionClasses;

    use Rjpinks\UfcScraper\ConnectionClasses\Config;
    use PDO;
    use Rjpinks\UfcScraper\Dto\FighterStatsDto;
    use Rjpinks\UfcScraper\Dto\EventDataDto;
    use Rjpinks\UfcScraper\Dto\FightStatsDto;

    class SQLiteConnection
    {
        private $pdo;

        public function connect(): PDO
        {
            try {
                $this->pdo = new PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
             } catch (\PDOException $e) {
                echo "Error Code: " . $e->getMessage() . PHP_EOL;
             }
            return $this->pdo;
        }

        public function insertFighterData(PDO $connection, FighterStatsDto $data): bool
        {
            $connection->beginTransaction();
            $sqlStatement = $connection->prepare(
                "INSERT INTO fighter (
                    first_name,
                    last_name,
                    record,
                    height_inches,
                    weight_in_lbs,
                    reach_inches,
                    stance,
                    birthdate,
                    strikes_landed_per_min,
                    striking_accuracy,
                    strikes_absorbed_per_min,
                    striking_defence,
                    average_takedowns_per_fifteen,
                    takedown_accuracy,
                    takedown_defence,
                    average_submissions_attempted_per_fifteen
                ) VALUES (
                    :first_name,
                    :last_name,
                    :record,
                    :height_inches,
                    :weight_in_lbs,
                    :reach_inches,
                    :stance,
                    :birthdate,
                    :strikes_landed_per_min,
                    :striking_accuracy,
                    :strikes_absorbed_per_min,
                    :striking_defence,
                    :average_takedowns_per_fifteen,
                    :takedown_accuracy,
                    :takedown_defence,
                    :average_submissions_attempted_per_fifteen
                )"
            );
            $sqlStatement->execute([
                ":first_name" => $data->firstName,
                ":last_name" => $data->lastName,
                ":record" => $data->record,
                ":height_inches" => $data->height,
                ":weight_in_lbs" => $data->weight,
                ":reach_inches" => $data->reach,
                ":stance" => $data->stance,
                ":birthdate" => $data->birthdate,
                ":strikes_landed_per_min" => $data->strikesPerMin,
                ":striking_accuracy" => $data->strikeAccuracy,
                ":strikes_absorbed_per_min" => $data->strikesAbsorbed,
                ":striking_defence" => $data->strikeDefence,
                ":average_takedowns_per_fifteen" => $data->takedowns,
                ":takedown_accuracy" => $data->takedownAccuracy,
                ":takedown_defence" => $data->takedownDefence,
                ":average_submissions_attempted_per_fifteen" => $data->submissionAttempts,                
            ]);
            $result = $connection->commit();
            return $result;
        }

        public function insertEventData(PDO $connection, EventDataDto $data): bool
        {
            $connection->beginTransaction();
            $sqlStatement = $connection->prepare(
                "INSERT INTO ufc_event (
                    event_name,
                    date_occurred,
                    event_location
                ) VALUES (
                    :event_name,
                    :date_occurred,
                    :event_location
                )"
            );
            $sqlStatement->execute([
                ":event_name" => $data->eventName,
                ":date_occurred" => $data->dateOccurred,
                ":event_location" => $data->eventLocation,           
            ]);
            $result = $connection->commit();
            return $result;
        }

        public function insertFightData(PDO $connection, FightStatsDto $data)
        {
            $connection->beginTransaction();
            $sqlStatement = $connection->prepare(
                "INSERT INTO fight (
                    event_id,
                    fighter_one_id,
                    fighter_two_id,
                    winner_id,
                    fighter_one_knockdowns,
                    fighter_two_knockdowns,
                    fighter_one_strikes,
                    fighter_two_strikes,
                    fighter_one_takedowns,
                    fighter_two_takedowns,
                    fighter_one_submission_attempts,
                    fighter_two_submission_attempts,
                    weight_class,
                    result_method,
                    last_round,
                    ending_time
                ) VALUES (
                    :event_id,
                    :fighter_one_id,
                    :fighter_two_id,
                    :winner_id,
                    :fighter_one_knockdowns,
                    :fighter_two_knockdowns,
                    :fighter_one_strikes,
                    :fighter_two_strikes,
                    :fighter_one_takedowns,
                    :fighter_two_takedowns,
                    :fighter_one_submission_attempts,
                    :fighter_two_submission_attempts,
                    :weight_class,
                    :result_method,
                    :last_round,
                    :ending_time
                )"
            );
            $sqlStatement->execute([
                ":event_id" => $data->eventId,
                ":fighter_one_id" => $data->fighterOneId,
                ":fighter_two_id" => $data->fighterTwoId,
                ":winner_id" => $data->winnerId,
                ":fighter_one_knockdowns" => $data->fighterOneKd,
                ":fighter_two_knockdowns" => $data->fighterTwoKd,
                ":fighter_one_strikes" => $data->fighterOneStrikes,
                ":fighter_two_strikes" => $data->fighterTwoStrikes,
                ":fighter_one_takedowns" => $data->fighterOneTd,
                ":fighter_two_takedowns" => $data->fighterTwoTd,
                ":fighter_one_submission_attempts" => $data->fighterOneSubs,
                ":fighter_two_submission_attempts" => $data->fighterTwoSubs,
                ":weight_class" => $data->weightClass,
                ":result_method" => $data->method,
                ":last_round" => $data->lastRound,
                ":ending_time" => $data->finalTime,                
            ]);
            $result = $connection->commit();
            return $result;            
        }
    }
?>