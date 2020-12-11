<?php

namespace App\Controller;

use App\Entity\Campeonato;
use App\Form\Campeonato1Type;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campeonato")
 */
class CampeonatoController extends AbstractController
{
    /**
     * @Route("/", name="campeonato_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $campeonatos = $this->getDoctrine()
            ->getRepository(Campeonato::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $campeonatos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('campeonato/index.html.twig', [
            'campeonatos' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="campeonato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $campeonato = new Campeonato();
        $form = $this->createForm(Campeonato1Type::class, $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campeonato);
            $entityManager->flush();

            return $this->redirectToRoute('campeonato_index');
        }

        return $this->render('campeonato/new.html.twig', [
            'campeonato' => $campeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcampeonato}", name="campeonato_show", methods={"GET"})
     */
    public function show(Campeonato $campeonato): Response
    {
        return $this->render('campeonato/show.html.twig', [
            'campeonato' => $campeonato,
        ]);
    }

    /**
     * @Route("/{idcampeonato}/edit", name="campeonato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campeonato $campeonato): Response
    {
        $form = $this->createForm(Campeonato1Type::class, $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campeonato_index');
        }

        return $this->render('campeonato/edit.html.twig', [
            'campeonato' => $campeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcampeonato}", name="campeonato_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Campeonato $campeonato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campeonato->getIdcampeonato(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campeonato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campeonato_index');
    }
}
