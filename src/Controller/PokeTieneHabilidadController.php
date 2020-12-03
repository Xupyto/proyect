<?php

namespace App\Controller;

use App\Entity\PokeTieneHabilidad;
use App\Entity\Pokemon;
use App\Entity\Habilidad;
use App\Entity\Formato;
use App\Form\PokeTieneHabilidadType;
use App\Repository\PokeTieneHabilidadRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poke/tiene/habilidad")
 */
class PokeTieneHabilidadController extends AbstractController
{
    /**
     * @Route("/", name="poke_tiene_habilidad_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, PokeTieneHabilidadRepository $pokeTieneHabilidadRepository): Response
    {
        $objetos = $pokeTieneHabilidadRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );
        return $this->render('poke_tiene_habilidad/index.html.twig', [
            'poke_tiene_habilidads' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="poke_tiene_habilidad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokeTieneHabilidad = new PokeTieneHabilidad();
        $form = $this->createForm(PokeTieneHabilidadType::class, $pokeTieneHabilidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokeTieneHabilidad);
            $entityManager->flush();

            return $this->redirectToRoute('poke_tiene_habilidad_index');
        }

        return $this->render('poke_tiene_habilidad/new.html.twig', [
            'poke_tiene_habilidad' => $pokeTieneHabilidad,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }


    /**
     * @Route("/edit/{formato}/{poke}/{hab}", name="poke_tiene_habilidad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato, Pokemon $poke, Habilidad $hab): Response
    {
        $em = $this->getDoctrine()->getManager();
        $poketienehab = $em->getRepository(PokeTieneHabilidad::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$hab->getIdhabilidad());
        $hola = $poketienehab[0];

        $form = $this->createForm(PokeTieneHabilidadType::class, $hola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poke_tiene_habilidad_index');
        }

        return $this->render('poke_tiene_habilidad/edit.html.twig', [
            'poke_tiene_habilidad' => $hola,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

    /**
     * @Route("/{formato}/{poke}/{hab}", name="poke_tiene_habilidad_delete", methods={"DELETE"})
     */
    public function delete(Formato $formato, Pokemon $poke, Habilidad $hab): Response
    {
        $em = $this->getDoctrine()->getManager();
        $poketienehab = $em->getRepository(PokeTieneHabilidad::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$hab->getIdhabilidad());
        $hola = $poketienehab[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('poke_tiene_habilidad_index');
    }
}
