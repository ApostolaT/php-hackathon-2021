<?php


namespace App\Service;


use App\Entity\Admin;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AdminService
{
    private $managerRegistry;
    private $normalizer;

    /**
     * AdminService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->normalizer = $normalizer;
    }

    public function get(int $id): ?array {
        $admin = $this->managerRegistry
            ->getRepository(Admin::class)
            ->find($id);

        //TODO catch the exception
        $admin = $this->normalizer->normalize($admin);
        return $admin;
    }
}