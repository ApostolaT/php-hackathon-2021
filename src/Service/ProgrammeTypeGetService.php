<?php


namespace App\Service;


use App\Entity\ProgrammeType;

class ProgrammeTypeGetService extends AbstractGetService
{
    public function get(int $id): ?array
    {
        $programmeType = $this->getManagerRegistry()
            ->getRepository(ProgrammeType::class)
            ->find($id);

        //TODO catch the exception
        $programmeType = $this->getNormalizer()->normalize($programmeType);
        return $programmeType;
    }
}