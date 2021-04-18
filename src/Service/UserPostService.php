<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Mapper\UserMapper;
use App\Validator\CNPValidator;
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
     * @var CNPValidator
     */
    private $cnpValidator;

    /**
     * UserPostService constructor.
     * @param ManagerRegistry $managerRegistry
     * @param DecoderInterface $decoder
     * @param NormalizerInterface $normalizer
     * @param UserMapper $userMapper
     * @param CNPValidator $cnpValidator
     */
    public function  __construct(
        ManagerRegistry $managerRegistry,
        DecoderInterface $decoder,
        NormalizerInterface $normalizer,
        UserMapper $userMapper,
        CNPValidator $cnpValidator
    ){
        parent::__construct($managerRegistry, $decoder, $normalizer);
        $this->userMapper = $userMapper;
        $this->cnpValidator = $cnpValidator;
    }

    public function createUser(string $user) {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $userDTO = $serializer->deserialize($user, UserDTO::class, 'json');

        if (!$this->cnpValidator->validate($userDTO->getCnp())) {
            return;
        }

        $user = $this->userMapper->toUser($userDTO);
        $this->getManagerRegistry()->getManager()->persist($user);
        $this->getManagerRegistry()->getManager()->flush();
    }
}