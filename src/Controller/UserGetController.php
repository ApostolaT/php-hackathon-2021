<?php


namespace App\Controller;


use App\Service\UserGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserGetController extends AbstractController
{
    /**
     * @var UserGetService
     */
    private $userGetService;

    /**
     * UserGetController constructor.
     * @param UserGetService $userGetService
     */
    public function __construct(UserGetService $userGetService)
    {
        $this->userGetService = $userGetService;
    }

    /**
     * @Route("/user/{id}", name="app_user_get", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getUserEntity(int $id): JsonResponse {
        $user = $this->userGetService->get($id);
        return new JsonResponse([
           'user' => $user
        ]);
    }
}