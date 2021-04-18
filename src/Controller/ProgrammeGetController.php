<?php


namespace App\Controller;


use App\Service\ProgrammeGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeGetController extends AbstractController
{
    private $programmeGetService;

    /**
     * ProgrammeGetController constructor.
     * @param ProgrammeGetService $programmeGetService
     */
    public function __construct(ProgrammeGetService $programmeGetService)
    {
        $this->programmeGetService = $programmeGetService;
    }

    /**
     * @Route("/programme/{id}", name="app_programme_get", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function getProgramme(int $id): Response
    {
        $programme = $this->programmeGetService->get($id);
        return new JsonResponse([
            $programme
        ]);
    }
}