<?php


namespace App\Service;


use App\Entity\Programme;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProgrammeGetService extends AbstractGetService
{
    /**
     * ProgrammeGetService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        parent::__construct($managerRegistry, $normalizer);
    }

    public function get(int $id): ?array {
        $programme = $this->getManagerRegistry()
            ->getRepository(Programme::class)
            ->find($id);

        //TODO catch the exception
        $programme = $this->getNormalizer()->normalize($programme);
        return $programme;
    }
}