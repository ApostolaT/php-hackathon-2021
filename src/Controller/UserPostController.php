<?php


namespace App\Controller;


use App\Service\UserPostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPostController extends AbstractController
{
    /**
     * @var UserPostService
     */
    private $userPostService;

    /**
     * UserPostController constructor
     * @param UserPostService $userPostService
     */
    public function __construct(UserPostService $userPostService)
    {
        $this->userPostService = $userPostService;
    }

    /**
     * @Route("/user", name="app_user_post", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postUser(Request $request): Response {
        $this->userPostService->createUser($request->getContent());

        return new Response("Dummy response yet", 200);
    }
}