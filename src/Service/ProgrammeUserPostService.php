<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Entity\Programme;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProgrammeUserPostService extends AbstractInsertionService
{
    /**
     * ProgrammeUserPostService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param DecoderInterface $decoder
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, DecoderInterface $decoder, NormalizerInterface $normalizer)
    {
        parent::__construct($managerRegistry, $decoder, $normalizer);
    }

    public function postProgrammeUser(string $user, $id) {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $programme = $this->getManagerRegistry()->getManager()->find(Programme::class, $id);
        if (!$programme || $programme->getMaxParticipants() == $programme->getParticipants()->count()) {
            return;
        }

        $userDTO = $serializer->deserialize($user, UserDTO::class, 'json');
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