<?php

namespace App\Controller;

use App\Entity\Spread;
use App\Form\SpreadType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spread")
 */
class SpreadController extends AbstractController
{
    /**
     * @Route("/", name="spread_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $spreads = $this->getDoctrine()
            ->getRepository(Spread::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $spreads,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('spread/index.html.twig', [
            'spreads' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="spread_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $spread = new Spread();
        $form = $this->createForm(SpreadType::class, $spread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spread);
            $entityManager->flush();

            return $this->redirectToRoute('spread_index');
        }

        return $this->render('spread/new.html.twig', [
            'spread' => $spread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idspread}/edit", name="spread_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spread $spread): Response
    {
        $form = $this->createForm(SpreadType::class, $spread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spread_index');
        }

        return $this->render('spread/edit.html.twig', [
            'spread' => $spread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idspread}", name="spread_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spread $spread): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spread->getIdspread(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spread);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spread_index');
    }
}
