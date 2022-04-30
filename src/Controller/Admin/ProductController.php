<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory, ProductRepository $productRepository){
        $this->formFactory = $formFactory;
        $this->productRepository = $productRepository;
    }
    /**
     * @Route("/admin/product/index", name="admin.product")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $products = $this->productRepository->findAll();
        return $this->render('admin/product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/product/create", name="admin.product.create")
     * @Route("/admin/product/{id}/edit", requirements={"id" = "\d+"}, name="admin.product.edit")
     */
    public function createOrEdit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        if (null == $id){
            $product = new Product();
        } else {
            $product = $this->productRepository->find($id);
        }
        $em = $this->getDoctrine()->getManager();
        $builder = $this->formFactory
        ->createBuilder(ProductType::class, $product);
        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin.product');
        }
        
        return $this->render('admin/product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/product/{id}/delete", requirements={"id" = "\d+"}, name="admin.product.delete")
     */
    public function delete(Request $request, $id): Response
    {
        $product = $this->productRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
    }
}
