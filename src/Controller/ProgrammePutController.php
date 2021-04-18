<?php


namespace App\Controller;


use App\Service\ProgrammePutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammePutController extends AbstractController
{
    private $programmePutService;

    /**
     * ProgrammePostController constructor.
     * @param ProgrammePutService $programmePutService
     */
    public function __construct(ProgrammePutService $programmePutService)
    {
        $this->programmePutService = $programmePutService;
    }

    /**
     * @Route("/programme/{id}", name="app_programme_put", methods={"PUT"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function putProgramme(Request $request, $id): Response {
        $this->programmePutService->updateProgramme($request->getContent(), $id);

        return new Response("Boiler Plate Response", 200);
    }
}