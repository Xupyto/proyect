<?php

namespace App\Controller;

use App\Entity\Objeto;
use App\Form\ObjetoType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objeto")
 */
class ObjetoController extends AbstractController
{
    /**
     * @Route("/", name="objeto_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $objetos = $this->getDoctrine()
            ->getRepository(Objeto::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $objetos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('objeto/index.html.twig', [
            'objetos' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="objeto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objeto = new Objeto();
        $form = $this->createForm(ObjetoType::class, $objeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objeto);
            $entityManager->flush();

            return $this->redirectToRoute('objeto_index');
        }

        return $this->render('objeto/new.html.twig', [
            'objeto' => $objeto,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idobjeto}/edit", name="objeto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objeto $objeto): Response
    {
        $form = $this->createForm(ObjetoType::class, $objeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objeto_index');
        }

        return $this->render('objeto/edit.html.twig', [
            'objeto' => $objeto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idobjeto}", name="objeto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objeto $objeto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objeto->getIdobjeto(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objeto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objeto_index');
    }
}
