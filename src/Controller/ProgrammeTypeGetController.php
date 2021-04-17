<?php

namespace App\Controller;

use App\Service\ProgrammeGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProgrammeTypeGetController extends AbstractController
{
    private $programmeTypeGetService;

    /**
     * programmeTypeGetServiceGetController constructor.
     * @param ProgrammeGetService $programmeTypeGetService
     */
    public function __construct(ProgrammeGetService $programmeTypeGetService)
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
