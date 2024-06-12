<?php
    namespace Rjpinks\UfcScraper\Dto;

    class FighterStatsDto
    {
        public String $firstName;
        public String $lastName;
        public String $record;
        public String $height;
        public String $weight;
        public String $reach;
        public String $stance;
        public String $birthdate;
        public String $strikesPerMin;
        public String $strikeAccuracy;
        public String $strikesAbsorbed;
        public String $strikeDefence;
        public String $takedowns;
        public String $takedownAccuracy;
        public String $takedownDefence;
        public String $submissionAttempts;

        public function __construct(
            $firstName, $lastName, $record, $height, $weight, $reach, $stance, $birthdate,
            $strikesPerMin, $strikeAccuracy, $strikesAbsorbed, $strikeDefence,
            $takedowns, $takedownAccuracy, $takedownDefence, $submissionAttempts
        )
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->record = $record;
            $this->height = $height;
            $this->weight = $weight;
            $this->reach = $reach;
            $this->stance = $stance;
            $this->birthdate = $birthdate;
            $this->strikesPerMin = $strikesPerMin;
            $this->strikeAccuracy = $strikeAccuracy;
            $this->strikesAbsorbed = $strikesAbsorbed;
            $this->strikeDefence = $strikeDefence;
            $this->takedowns = $takedowns;
            $this->takedownAccuracy = $takedownAccuracy;
            $this->takedownDefence = $takedownDefence;
            $this->submissionAttempts = $submissionAttempts;
        }
    }
?>