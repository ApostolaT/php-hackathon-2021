<?php


namespace App\Mapper;


use App\DTO\UserDTO;
use App\Entity\User;
use App\Factory\UserFactory;

class UserMapper
{
    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * ProgrammeMapper constructor.
     * @param UserFactory $userFactory
     */
    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function toUser(UserDTO $userDTO): User {
        return $this->userFactory->toUser($userDTO);
    }
}