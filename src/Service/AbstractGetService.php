<?php


namespace App\Service;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AbstractGetService
{
    private $managerRegistry;
    private $normalizer;

    /**
     * AdminGetService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, NormalizerInterface $normalizer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->normalizer = $normalizer;
    }

    /**
     * @return ManagerRegistry
     */
    public function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    }

    /**
     * @return NormalizerInterface
     */
    public function getNormalizer(): NormalizerInterface
    {
        return $this->normalizer;
    }
}