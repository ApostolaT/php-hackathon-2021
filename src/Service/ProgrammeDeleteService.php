<?php


namespace App\Service;


use App\Entity\Programme;
use Doctrine\Persistence\ManagerRegistry;

class ProgrammeDeleteService
{
    /**
     * @var ManagerRegistry $repoManager
     */
    private $repoManager;

    /**
     * ProgrammeDeleteService constructor.
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repoManager = $managerRegistry;
    }

    public function delete($id) {
        $programme = $this->repoManager->getManager()->find(Programme::class, $id);

        if ($programme) {
            $this->repoManager->getManager()->remove($programme);
            $this->repoManager->getManager()->flush();
        }
    }
}