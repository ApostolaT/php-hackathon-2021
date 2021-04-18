<?php


namespace App\Controller;


use App\DTO\ProgrammeDTO;
use App\Entity\Programme;
use App\Service\ProgrammePostGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammePostController extends AbstractController
{
    private $programmePostService;

    /**
     * ProgrammePostController constructor.
     * @param ProgrammePostGetService $programmePostService
     */
    public function __construct(ProgrammePostGetService $programmePostService)
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