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

class CategoryController extends AbstractController
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory, CategoryRepository $categoryRepository){
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @Route("/admin/category/index", name="admin.category")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $this->categoryRepository->findAll();
        // dump($categories);die;
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/category/create", name="admin.category.create")
     * @Route("/admin/category/{id}/edit", requirements={"id" = "\d+"}, name="admin.category.edit")
     */
    public function createOrEdit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        if (null == $id){
            $category = new Category();
        } else {
            $category = $this->categoryRepository->find($id);
        }
        $em = $this->getDoctrine()->getManager();
        $builder = $this->formFactory
        ->createBuilder(CategoryType::class, $category);
        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('admin.category');
        }
        
        $error = '';
        if ($form->getErrors()->count() > 0) {
            foreach ($form->getErrors() as $formError) {
                $error = $formError->getMessage();
            }
        }
        // dump($error);die;
        return $this->render('admin/category/create.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/admin/category/{id}/delete", requirements={"id" = "\d+"}, name="admin.category.delete")
     */
    public function delete(Request $request, $id): Response
    {
        $category = $this->categoryRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('admin.category');
    }
}
