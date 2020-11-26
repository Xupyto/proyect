<?php

namespace App\Controller;

use App\Entity\Formato;
use App\Form\FormatoType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formato")
 */
class FormatoController extends AbstractController
{
    /**
     * @Route("/", name="formato_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $formatos = $this->getDoctrine()
            ->getRepository(Formato::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $formatos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('formato/index.html.twig', [
            'formatos' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="formato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formato = new Formato();
        $form = $this->createForm(FormatoType::class, $formato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formato);
            $entityManager->flush();

            return $this->redirectToRoute('formato_index');
        }

        return $this->render('formato/new.html.twig', [
            'formato' => $formato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formato_show", methods={"GET"})
     */
    public function show(Formato $formato): Response
    {
        return $this->render('formato/show.html.twig', [
            'formato' => $formato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato): Response
    {
        $form = $this->createForm(FormatoType::class, $formato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formato_index');
        }

        return $this->render('formato/edit.html.twig', [
            'formato' => $formato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formato_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formato $formato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formato->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formato_index');
    }
}
