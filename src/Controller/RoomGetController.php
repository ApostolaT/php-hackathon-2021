<?php

namespace App\Controller;

use App\Service\RoomGetGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomGetController extends AbstractController
{
    private $roomGetService;

    /**
     * AdminGetController constructor.
     * @param RoomGetGetService $roomGetService
     */
    public function __construct(RoomGetGetService $roomGetService)
    {
        $this->roomGetService = $roomGetService;
    }

    /**
     * @Route("/room/{id}", name="app_room_get", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function getRoom(int $id): Response
    {
        $roomGetService = $this->roomGetService->get($id);
        return new JsonResponse([
            'room' => $roomGetService
        ]);
    }
}
