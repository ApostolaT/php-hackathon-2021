<?php


namespace App\Controller;


use App\Service\ProgrammeDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeDeleteController extends AbstractController
{
    /**
     * @var ProgrammeDeleteService
     */
    private $programmeDeleteService;

    /**
     * ProgrammeDeleteController constructor.
     * @param ProgrammeDeleteService $programmeDeleteService
     */
    public function __construct(ProgrammeDeleteService $programmeDeleteService)
    {
        $this->programmeDeleteService = $programmeDeleteService;
    }

    /**
     * @Route("/programme/{id}", name="app_programme_delete", methods={"DELETE"})
     * @param $id
     * @return Response
     */
    public function delete($id) {
        $this->programmeDeleteService->delete($id);

        return new Response("Delete successful", 200);
    }
}