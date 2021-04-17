<?php


namespace App\Service;


use App\Entity\Programme;

class ProgrammeGetService extends AbstractService
{
    public function get(int $id): ?array {
        $admin = $this->getManagerRegistry()
            ->getRepository(Programme::class)
            ->find($id);

        //TODO catch the exception
        $admin = $this->getNormalizer()->normalize($admin);
        return $admin;
    }
}