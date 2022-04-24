<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/index", name="admin.category")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('admin/category/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
