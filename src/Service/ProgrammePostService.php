<?php


namespace App\Service;


use App\DTO\ProgrammeDTO;
use App\Entity\ProgrammeType;
use App\Entity\Room;
use App\Mapper\ProgrammeMapper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProgrammePostService extends AbstractInsertionService
{
    /**
     * @var ProgrammeMapper
     */
    private $programmeMapper;

    /**
     * ProgrammePostService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param DecoderInterface $decoder
     * @param NormalizerInterface $normalizer
     * @param ProgrammeMapper $programmeMapper
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        DecoderInterface $decoder,
        NormalizerInterface $normalizer,
        ProgrammeMapper $programmeMapper
    ){
        parent::__construct($managerRegistry, $normalizer);
        $this->programmeMapper = $programmeMapper;
    }

    public function createProgramme(string $programme) {
        // Could not figure out why DI is not working properly.
        //$programmeDTO = $this->getSerializer()->deserialize($programme, ProgrammeDTO::class, 'json');
        //$serializer = new Serializer([$this->getNormalizer()], [$this->getDecoder()]);
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        //TODO incorporate checkings
        $roomRepo = $this->getManagerRegistry()->getRepository(Room::class);
        $programmeTypeRepo = $this->getManagerRegistry()->getRepository(ProgrammeType::class);
        $programmeRepo = $this->getManagerRegistry()->getManager();

        $programmeDTO = $serializer->deserialize($programme, ProgrammeDTO::class, 'json');
        $programme = $this->programmeMapper->toProgramme($programmeDTO);

        $room = $roomRepo->find($programmeDTO->getRoom());
        $programmeType = $programmeTypeRepo->find($programmeDTO->getProgrammeType());
        $programme->setRoom($room);
        $programme->setProgrammeType($programmeType);
        $programmeRepo->persist($programme);
        $programmeRepo->flush();
    }
}