<?php


namespace App\Service;


use App\Entity\Programme;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProgrammeUserGetService extends AbstractGetService
{
    /**
     * ProgrammeUserGetService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        parent::__construct($managerRegistry, $normalizer);
    }

    public function getUsersForProgramme(int $id): ?string {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

        $programme = $this->getManagerRegistry()->getManager()->find(Programme::class, $id);
        $users = $programme->getParticipants();

        return $serializer->serialize($users, 'json', ['groups' => 'user']);
    }
}