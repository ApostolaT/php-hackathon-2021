<?php


namespace App\Service;


use App\Entity\Programme;

class ProgrammeGetService extends AbstractGetService
{
    public function get(int $id): ?array {
        $programme = $this->getManagerRegistry()
            ->getRepository(Programme::class)
            ->find($id);

        //TODO catch the exception
        $programme = $this->getNormalizer()->normalize($programme);
        return $programme;
    }
}