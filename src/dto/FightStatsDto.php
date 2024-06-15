<?php
    namespace Rjpinks\UfcScraper\Dto;

    class FightStatsDto
    {
        public String $eventId;
        public String $fighterOneId;
        public String $fighterTwoId;
        public String $winnerId;
        public String $fighterOneKd;
        public String $fighterOneStrikes;
        public String $fighterOneTd;
        public String $fighterOneSubs;
        public String $fighterTwoKd;
        public String $fighterTwoStrikes;
        public String $fighterTwoTd;
        public String $fighterTwoSubs;
        public String $weightClass;
        public String $method;
        public String $lastRound;
        public String $finalTime;

        public function __construct(
            $eventId, $fighterOneId, $fighterTwoId, $winnerId, $fighterOneKd,
            $fighterOneStrikes, $fighterOneTd, $fighterOneSubs, $fighterTwoKd,
            $fighterTwoStrikes, $fighterTwoTd, $fighterTwoSubs, $weightClass,
            $method, $lastRound, $finalTime
        )
        {
            $this->eventId = $eventId;
            $this->fighterOneId = $fighterOneId;
            $this->fighterTwoId = $fighterTwoId;
            $this->winnerId = $winnerId;
            $this->fighterOneKd = $fighterOneKd;
            $this->fighterOneStrikes = $fighterOneStrikes;
            $this->fighterOneTd = $fighterOneTd;
            $this->fighterOneSubs = $fighterOneSubs;
            $this->fighterTwoKd = $fighterTwoKd;
            $this->fighterTwoStrikes = $fighterTwoStrikes;
            $this->fighterTwoTd = $fighterTwoTd;
            $this->fighterTwoSubs = $fighterTwoSubs;
            $this->weightClass = $weightClass;
            $this->method = $method;
            $this->lastRound = $lastRound;
            $this->finalTime = $finalTime;
        }
    }
?>