<?php


namespace App\DTO;


class ProgrammeDTO
{
    /**
     * @var string
     */
    private $programmeType;
    /**
     * @var string
     */
    private $room;
    /**
     * @var string
     */
    private $startDate;
    /**
     * @var string
     */
    private $endDate;
    /**
     * @var string
     */
    private $maxParticipants;

    /**
     * @return string
     */
    public function getProgrammeType(): string
    {
        return $this->programmeType;
    }

    /**
     * @param string $programmeType
     */
    public function setProgrammeType($programmeType): void
    {
        $this->programmeType = $programmeType;
    }

    /**
     * @return string
     */
    public function getRoom(): string
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     */
    public function setRoom($room): void
    {
        $this->room = $room;
    }

    /**
     * @return mixed
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getMaxParticipants(): string
    {
        return $this->maxParticipants;
    }

    /**
     * @param mixed $maxParticipants
     */
    public function setMaxParticipants($maxParticipants): void
    {
        $this->maxParticipants = $maxParticipants;
    }
}