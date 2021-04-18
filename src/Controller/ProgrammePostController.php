<?php


namespace App\Controller;


use App\Service\ProgrammePostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammePostController extends AbstractController
{
    private $programmePostService;

    /**
     * ProgrammePostController constructor.
     * @param ProgrammePostService $programmePostService
     */
    public function __construct(ProgrammePostService $programmePostService)
    {
        $this->programmePostService = $programmePostService;
    }

    /**
     * @Route("/programme", name="app_programme_post", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postProgramme(Request $request): Response {
        $this->programmePostService->createProgramme($request->getContent());

        return new Response("Boiler Plate Response", 200);
    }
}