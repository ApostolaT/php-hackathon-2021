<?php


namespace App\Service;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

class AbstractGetService
{
    private $managerRegistry;
    private $serializer;

    /**
     * AdminGetService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     */
    public function __construct(ManagerRegistry $managerRegistry, SerializerInterface $serializer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->serializer = $serializer;
    }

    /**
     * @return ManagerRegistry
     */
    public function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    }

    /**
     *
     */
    public function getSerializer()
    {
        return $this->serializer;
    }
}