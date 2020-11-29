<?php

namespace App\Controller;

use App\Entity\Habilidad;
use App\Form\HabilidadType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/habilidad")
 */
class HabilidadController extends AbstractController
{
    /**
     * @Route("/", name="habilidad_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $habilidads = $this->getDoctrine()
            ->getRepository(Habilidad::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $habilidads,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('habilidad/index.html.twig', [
            'habilidads' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="habilidad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $habilidad = new Habilidad();
        $form = $this->createForm(HabilidadType::class, $habilidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habilidad);
            $entityManager->flush();

            return $this->redirectToRoute('habilidad_index');
        }

        return $this->render('habilidad/new.html.twig', [
            'habilidad' => $habilidad,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idhabilidad}/edit", name="habilidad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Habilidad $habilidad): Response
    {
        $form = $this->createForm(HabilidadType::class, $habilidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('habilidad_index');
        }

        return $this->render('habilidad/edit.html.twig', [
            'habilidad' => $habilidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idhabilidad}", name="habilidad_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Habilidad $habilidad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habilidad->getIdhabilidad(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($habilidad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('habilidad_index');
    }
}
