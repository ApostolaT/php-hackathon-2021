<?php


namespace App\Controller;


use App\Service\ProgrammeUserPostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeUserPostController extends AbstractController
{
    /**
     * @var ProgrammeUserPostService
     */
    private $programmeUserPostService;

    /**
     * ProgrammeUserPostController constructor.
     * @param ProgrammeUserPostService $programmeUserPostService
     */
    public function __construct(ProgrammeUserPostService $programmeUserPostService)
    {
        $this->programmeUserPostService = $programmeUserPostService;
    }

    /**
     * @Route("/programme/{id}/user", name="app_programme_user_post", methods={"post"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function putProgrammeUser(Request $request, $id): Response {
        $this->programmeUserPostService->postProgrammeUser($request->getContent(), $id);

        return new Response("Boiler Plate Response", 200);
    }
}