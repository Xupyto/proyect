<?php

namespace App\Controller;

use App\Entity\PokePuedeAprenderMov;
use App\Entity\Pokemon;
use App\Entity\Movimiento;
use App\Entity\Formato;
use App\Form\PokePuedeAprenderMovType;
use App\Repository\Pokemon_aprende_movRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poke/puede/aprender/mov")
 */
class PokePuedeAprenderMovController extends AbstractController
{
    /**
     * @Route("/", name="poke_puede_aprender_mov_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, Pokemon_aprende_movRepository $pokemon_aprende_movRepository): Response
    {
        $objetos = $pokemon_aprende_movRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );

        return $this->render('poke_puede_aprender_mov/index.html.twig', [
            'poke_puede_aprender_movs' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="poke_puede_aprender_mov_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokePuedeAprenderMov = new PokePuedeAprenderMov();
        $form = $this->createForm(PokePuedeAprenderMovType::class, $pokePuedeAprenderMov);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokePuedeAprenderMov);
            $entityManager->flush();

            return $this->redirectToRoute('poke_puede_aprender_mov_index');
        }

        return $this->render('poke_puede_aprender_mov/new.html.twig', [
            'poke_puede_aprender_mov' => $pokePuedeAprenderMov,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }


    /**
     * @Route("/{formato}", name="poke_puede_aprender_mov_show", methods={"GET"})
     */
    public function show(PokePuedeAprenderMov $pokePuedeAprenderMov): Response
    {
        return $this->render('poke_puede_aprender_mov/show.html.twig', [
            'poke_puede_aprender_mov' => $pokePuedeAprenderMov,
        ]);
    }

    /**
     * @Route("/edit/{formato}/{poke}/{mov}", name="poke_puede_aprender_mov_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato, Pokemon $poke, Movimiento $mov): Response
    {
        
        $em = $this->getDoctrine()->getManager();
        $pokePuedeAprenderMov = $em->getRepository(PokePuedeAprenderMov::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$mov->getIdMov());
        $hola = $pokePuedeAprenderMov[0];
        $form = $this->createForm(PokePuedeAprenderMovType::class, $hola);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('poke_puede_aprender_mov_index');
        }

        return $this->render('poke_puede_aprender_mov/edit.html.twig', [
            'poke_puede_aprender_mov' => $pokePuedeAprenderMov,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }


    

    /**
     * @Route("/{formato}/{poke}/{mov}", name="poke_puede_aprender_mov_delete", methods={"DELETE", "GET"})
     */
    public function delete(Formato $formato, Pokemon $poke, Movimiento $mov): Response
    {
       
        $em = $this->getDoctrine()->getManager();
        $pokePuedeAprenderMov = $em->getRepository(PokePuedeAprenderMov::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$mov->getIdMov());
        $hola = $pokePuedeAprenderMov[0];
        
        $em->remove($hola);
        $em->flush();
        

        return $this->redirectToRoute('poke_puede_aprender_mov_index');
    }
}
