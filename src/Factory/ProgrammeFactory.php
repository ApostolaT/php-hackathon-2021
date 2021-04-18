<?php


namespace App\Factory;


use App\Builder\ProgrammeBuilder;
use App\DTO\ProgrammeDTO;
use App\Entity\Programme;

class ProgrammeFactory
{
    /**
     * @var ProgrammeBuilder
     */
    private $programmeBuilder;

    /**
     * ProgrammeFactory constructor.
     * @param ProgrammeBuilder $programmeBuilder
     */
    public function __construct(ProgrammeBuilder $programmeBuilder)
    {
        $this->programmeBuilder = $programmeBuilder;
    }

    public function toProgramme(ProgrammeDTO $programmeDTO): Programme {
        $this->programmeBuilder->build();
        $this->programmeBuilder->addMaxParticipants($programmeDTO->getMaxParticipants());
        $this->programmeBuilder->addStartDate($programmeDTO->getStartDate());
        $this->programmeBuilder->addEndDate($programmeDTO->getEndDate());

        return $this->programmeBuilder->getProgramme();
    }

}