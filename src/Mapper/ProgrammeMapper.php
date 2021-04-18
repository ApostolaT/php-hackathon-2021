<?php


namespace App\Mapper;


use App\DTO\ProgrammeDTO;
use App\Entity\Programme;
use  App\Factory\ProgrammeFactory;

class ProgrammeMapper
{
    /**
     * @var ProgrammeFactory
     */
    private $programmeFactory;

    /**
     * ProgrammeMapper constructor.
     * @param ProgrammeFactory $programmeFactory
     */
    public function __construct(ProgrammeFactory $programmeFactory)
    {
        $this->programmeFactory = $programmeFactory;
    }

    public function toProgramme(ProgrammeDTO $programmeDTO): Programme {
        return $this->programmeFactory->toProgramme($programmeDTO);
    }
}