<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class TranslateController extends AbstractController
{
    /**
     * @Route("/translate", name="translate")
     */
    public function translate(Request $request): Response
    {
        $category = $this->categoryRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('admin.category');
    }
}
