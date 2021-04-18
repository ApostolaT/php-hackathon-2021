<?php


namespace App\Factory;


use App\Builder\UserBuilder;
use App\DTO\UserDTO;
use App\Entity\User;

class UserFactory
{
    /**
     * @var UserBuilder
     */
    private $userBuilder;

    /**
     * ProgrammeFactory constructor.
     * @param UserBuilder $userBuilder
     */
    public function __construct(UserBuilder $userBuilder)
    {
        $this->userBuilder = $userBuilder;
    }

    public function toUser(UserDTO $userDTO): User {
        $this->userBuilder->build();
        $this->userBuilder->addName($userDTO->getName());
        $this->userBuilder->addCNP($userDTO->getCnp());

        return $this->userBuilder->getUser();
    }
}