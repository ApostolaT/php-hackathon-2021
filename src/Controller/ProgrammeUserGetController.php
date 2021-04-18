<?php


namespace App\Controller;


use App\Service\ProgrammeUserGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeUserGetController extends AbstractController
{
    /**
     * @var ProgrammeUserGetService
     */
    private $programmeUserGetService;

    /**
     * UserGetController constructor.
     * @param ProgrammeUserGetService $programmeUserGetService
     */
    public function __construct(ProgrammeUserGetService $programmeUserGetService)
    {
        $this->programmeUserGetService = $programmeUserGetService;
    }

    /**
     * @Route("/programme/{id}/user", name="app_programme_user_get_all", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function getUserEntity(int $id): Response
    {
        $users = $this->programmeUserGetService->getUsersForProgramme($id);
        return new Response(
            $users,
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}