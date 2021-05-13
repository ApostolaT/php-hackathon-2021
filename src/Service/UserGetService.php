<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserGetService extends AbstractGetService
{
    public function __construct(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        parent::__construct($managerRegistry, $normalizer);
    }

    public function get(int $id): ?array {
        $user = $this->getManagerRegistry()
            ->getRepository(User::class)
            ->find($id);

        //TODO catch the exception
        $user = $this->getSerializer()->normalize($user);
        return $user;
    }
}