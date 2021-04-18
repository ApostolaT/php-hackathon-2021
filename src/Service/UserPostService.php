<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Mapper\UserMapper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserPostService extends AbstractInsertionService
{
    /**
     * @var UserMapper
     */
    private $userMapper;

    /**
     * UserPostService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param DecoderInterface $decoder
     * @param NormalizerInterface $normalizer
     * @param UserMapper $userMapper
     */
    public function  __construct(
        ManagerRegistry $managerRegistry,
        DecoderInterface $decoder,
        NormalizerInterface $normalizer,
        UserMapper $userMapper
    ){
        parent::__construct($managerRegistry, $decoder, $normalizer);
        $this->userMapper = $userMapper;
    }

    public function createUser(string $user) {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $userDTO = $serializer->deserialize($user, UserDTO::class, 'json');
        $user = $this->userMapper->toUser($userDTO);
        //TODO test the CNP
        $this->getManagerRegistry()->getManager()->persist($user);
        $this->getManagerRegistry()->getManager()->flush();
    }
}