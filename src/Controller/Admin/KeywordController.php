<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\KeywordRepository;
use App\Entity\Keyword;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\KeywordType;
use Symfony\Component\HttpFoundation\Request;

class KeywordController extends AbstractController
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var KeywordRepository
     */
    protected $keywordRepository;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory, KeywordRepository $keywordRepository){
        $this->formFactory = $formFactory;
        $this->keywordRepository = $keywordRepository;
    }
    /**
     * @Route("/admin/keyword/index", name="admin.keyword")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $keywords = $this->keywordRepository->findAll();
        return $this->render('admin/keyword/index.html.twig', [
            'keywords' => $keywords,
        ]);
    }

    /**
     * @Route("/admin/keyword/create", name="admin.keyword.create")
     * @Route("/admin/keyword/{id}/edit", requirements={"id" = "\d+"}, name="admin.keyword.edit")
     */
    public function createOrEdit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        if (null == $id){
            $keyword = new Keyword();
        } else {
            $keyword = $this->keywordRepository->find($id);
        }
        $em = $this->getDoctrine()->getManager();
        $builder = $this->formFactory
        ->createBuilder(KeywordType::class, $keyword);
        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($keyword);
            $em->flush();
            return $this->redirectToRoute('admin.keyword');
        }
        
        $error = '';
        if ($form->getErrors()->count() > 0) {
            foreach ($form->getErrors() as $formError) {
                $error = $formError->getMessage();
            }
        }
        // dump($error);die;
        return $this->render('admin/keyword/create.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/admin/keyword/{id}/delete", requirements={"id" = "\d+"}, name="admin.keyword.delete")
     */
    public function delete(Request $request, $id): Response
    {
        $keyword = $this->keywordRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($keyword);
        $em->flush();
        return $this->redirectToRoute('admin.keyword');
    }
}
