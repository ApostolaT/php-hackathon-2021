<?php


namespace App\Service;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;

class AbstractPostService
{
    private $managerRegistry;
    private $decoder;
    private $normalizer;
    private $serializer;

    /**
     * AdminGetService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param DecoderInterface $decoder
     * @param NormalizerInterface $normalizer
     */
    public function __construct(ManagerRegistry $managerRegistry, DecoderInterface $decoder, NormalizerInterface $normalizer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->decoder = $decoder;
        $this->normalizer = $normalizer;
        $this->serializer = new Serializer([$this->normalizer], [$this->decoder]);
    }

    /**
     * @return ManagerRegistry
     */
    public function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    }

    /**
     * @return DecoderInterface
     */
    public function getDecoder(): DecoderInterface
    {
        return $this->decoder;
    }

    /**
     * @return NormalizerInterface
     */
    public function getNormalizer(): NormalizerInterface
    {
        return $this->normalizer;
    }

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

}