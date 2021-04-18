<?php

namespace App\Controller;

use App\Service\ProgrammeTypeGetGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeTypeGetController extends AbstractController
{
    private $programmeTypeGetService;

    /**
     * programmeTypeGetServiceGetController constructor.
     * @param ProgrammeTypeGetGetService $programmeTypeGetService
     */
    public function __construct(ProgrammeTypeGetGetService $programmeTypeGetService)
    {
        $this->programmeTypeGetService = $programmeTypeGetService;
    }

    /**
     * @Route("/programmetype/{id}", name="app_programme_type_get", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function getProgrammeType(int $id): Response
    {
        $programmeType = $this->programmeTypeGetService->get($id);
        return new JsonResponse([
            'programme type' => $programmeType
        ]);
    }
}
