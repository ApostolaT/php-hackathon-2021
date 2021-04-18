<?php


namespace App\Builder;


use App\Entity\Programme;
use DateTime;

class ProgrammeBuilder
{
    /**
     * @var Programme;
     */
    private $programme;

    public function build(): void {
        $this->programme = new Programme();
    }

    public function addMaxParticipants(string $maxParticipants) {
        $this->programme->setMaxParticipants((int)$maxParticipants);
    }

    public function addStartDate(string $startDate) {
        $dateTime = new DateTime($startDate);
        $this->programme->setStartDate($dateTime);
    }

    public function addEndDate(string $endDate) {
        $dateTime = new DateTime($endDate);
        $this->programme->setEndDate($dateTime);
    }

    public function getProgramme(): Programme {
        return $this->programme;
    }
}