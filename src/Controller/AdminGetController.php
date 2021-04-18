<?php

namespace App\Controller;

use App\Service\AdminGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGetController extends AbstractController
{
    private $adminService;

    /**
     * AdminGetController constructor.
     * @param AdminGetService $adminService
     */
    public function __construct(AdminGetService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * @Route("/admin/{id}", name="app_admin_get", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function getAdmin(int $id): Response
    {
        $admin = $this->adminService->get($id);
        return new JsonResponse([
            'admin' => $admin
        ]);
    }
}
