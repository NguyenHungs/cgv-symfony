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

class LanguageController extends AbstractController
{ 
    /**
     * @Route("/admin/language/{lang}", requirements={"lang" = "[^/]+"}, name="admin.language")
     */
    public function index(Request $request, $lang): Response
    {
        if(!is_null($lang)) { 
            $request->getSession()->set('_locale', $lang);
            // $request->setLocale($lang);
        }
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }
 
}
