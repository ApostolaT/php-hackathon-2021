<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Entity\Programme;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

class ProgrammeUserPostService extends AbstractInsertionService
{
    /**
     * ProgrammeUserPostService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        SerializerInterface $serializer
    ){
        parent::__construct($managerRegistry, $serializer);
    }

    public function postProgrammeUser(string $user, $id) {
        $programme = $this->getManagerRegistry()->getManager()->find(Programme::class, $id);
        if (!$programme || $programme->getMaxParticipants() == $programme->getParticipants()->count()) {
            return;
        }

        $userDTO = $this->getSerializer()->deserialize($user, UserDTO::class, 'json');
        $user = $this->getManagerRegistry()->getManager()->find(User::class, $userDTO->getId());
        if (!$user || $programme->getParticipants()->contains($user)) {
            return;
        }

        $programme->addParticipant($user);

        $this->getManagerRegistry()->getManager()->persist($programme);
        $this->getManagerRegistry()->getManager()->flush();

        return;
    }
}