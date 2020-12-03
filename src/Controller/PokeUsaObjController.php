<?php

namespace App\Controller;

use App\Entity\PokeUsaObj;
use App\Entity\Pokemon;
use App\Entity\Objeto;
use App\Entity\Formato;
use App\Form\PokeUsaObjType;
use App\Repository\Pokemon_usaobjRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poke/usa/obj")
 */
class PokeUsaObjController extends AbstractController
{
    /**
     * @Route("/", name="poke_usa_obj_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request,Pokemon_usaobjRepository $pokemon_usaobjRepository): Response
    {
        $objetos = $pokemon_usaobjRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );
        return $this->render('poke_usa_obj/index.html.twig', [
            'poke_usa_objs' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="poke_usa_obj_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokeUsaObj = new PokeUsaObj();
        $form = $this->createForm(PokeUsaObjType::class, $pokeUsaObj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokeUsaObj);
            $entityManager->flush();

            return $this->redirectToRoute('poke_usa_obj_index');
        }

        return $this->render('poke_usa_obj/new.html.twig', [
            'poke_usa_obj' => $pokeUsaObj,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

  

    /**
     * @Route("/edit/{formato}/{poke}/{obj}", name="poke_usa_obj_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,  Formato $formato, Pokemon $poke, Objeto $obj): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokeusaobj = $em->getRepository(PokeUsaObj::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$obj->getIdobjeto());
        $hola = $pokeusaobj[0];
        $form = $this->createForm(PokeUsaObjType::class, $hola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poke_usa_obj_index');
        }

        return $this->render('poke_usa_obj/edit.html.twig', [
            'poke_usa_obj' => $hola,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

    /**
     * @Route("/{formato}/{poke}/{obj}", name="poke_usa_obj_delete", methods={"DELETE"})
     */
    public function delete(Formato $formato, Pokemon $poke, Objeto $obj): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokeusaobj = $em->getRepository(PokeUsaObj::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$obj->getIdobjeto());
        $hola = $pokeusaobj[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('poke_usa_obj_index');
    }
}
