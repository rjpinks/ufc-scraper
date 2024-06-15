<?php
    namespace Rjpinks\UfcScraper\Dto;

    class EventDataDto
    {
        public String $eventName;
        public String $dateOccurred;
        public String $eventLocation;

        public function __construct($eventName, $dateOccurred, $eventLocation)
        {
            $this->eventName = $eventName;
            $this->dateOccurred = $dateOccurred;
            $this->eventLocation = $eventLocation;
        }
    }
?>