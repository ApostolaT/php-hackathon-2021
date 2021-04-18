<?php


namespace App\Builder;


use App\Entity\User;

class UserBuilder
{
    /**
     * @var User;
     */
    private $user;

    public function build(): void {
        $this->user = new User();
    }

    public function addName(string $name) {
        $this->user->setName($name);
    }

    public function addCNP(string $cnp) {
        $this->user->setCnp($cnp);
    }

    public function getUser(): User {
        return $this->user;
    }
}