<?php


namespace App\Service;


use App\DTO\ProgrammeDTO;
use App\Entity\Programme;
use App\Entity\ProgrammeType;
use App\Entity\Room;
use App\Mapper\ProgrammeMapper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProgrammePutService extends AbstractInsertionService {
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
    public function __construct(ManagerRegistry $managerRegistry, DecoderInterface $decoder, NormalizerInterface $normalizer, ProgrammeMapper $programmeMapper)
    {
        parent::__construct($managerRegistry, $normalizer);
        $this->programmeMapper = $programmeMapper;
    }

    public function updateProgramme(string $programme, string $id) {
        $roomRepo = $this->getManagerRegistry()->getRepository(Room::class);
        $programmeTypeRepo = $this->getManagerRegistry()->getRepository(ProgrammeType::class);
        $programmeRepo = $this->getManagerRegistry()->getManager();

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $programmeDTO = $serializer->deserialize($programme, ProgrammeDTO::class, 'json');
        $programme = $this->programmeMapper->toProgramme($programmeDTO);
        $programmeDB = $programmeRepo->find(Programme::class, $id);

        if ($programmeDB === null) {
            $programmeRepo->persist($programme);
            $programmeRepo->flush();

            return;
        }

        $programmeDB->setMaxParticipants($programme->getMaxParticipants());
        $programmeDB->setStartDate($programme->getStartDate());
        $programmeDB->setEndDate($programme->getEndDate());
        $room = $roomRepo->find($programmeDTO->getRoom());
        $programmeType = $programmeTypeRepo->find($programmeDTO->getProgrammeType());
        $programmeDB->setRoom($room);
        $programmeDB->setProgrammeType($programmeType);

        $programmeRepo->persist($programmeDB);
        $programmeRepo->flush();
    }
}