<?php


namespace App\Service;


use App\Entity\Programme;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

class ProgrammeUserGetService extends AbstractGetService
{
    public function __construct(
        ManagerRegistry $managerRegistry,
        SerializerInterface $serializer
    ) {
        parent::__construct($managerRegistry, $serializer);
    }

    public function getUsersForProgramme(int $id): ?string {
        $programme = $this->getManagerRegistry()->getManager()->find(Programme::class, $id);
        $users = $programme->getParticipants();

        return $this->getSerializer()->serialize($users, 'json');
    }
}