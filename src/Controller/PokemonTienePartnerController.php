<?php

namespace App\Controller;

use App\Entity\PokemonTienePartner;
use App\Entity\Pokemon;
use App\Entity\Formato;
use App\Form\PokemonTienePartnerType;
use App\Repository\PokemonTienePartnerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pokemon/tiene/partner")
 */
class PokemonTienePartnerController extends AbstractController
{
    /**
     * @Route("/", name="pokemon_tiene_partner_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, PokemonTienePartnerRepository $pokemonTienePartnerRepository): Response
    {
        $objetos = $pokemonTienePartnerRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );

        return $this->render('pokemon_tiene_partner/index.html.twig', [
            'pokemon_tiene_partners' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="pokemon_tiene_partner_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokemonTienePartner = new PokemonTienePartner();
        $form = $this->createForm(PokemonTienePartnerType::class, $pokemonTienePartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemonTienePartner);
            $entityManager->flush();

            return $this->redirectToRoute('pokemon_tiene_partner_index');
        }

        return $this->render('pokemon_tiene_partner/new.html.twig', [
            'pokemon_tiene_partner' => $pokemonTienePartner,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }


    /**
     * @Route("/edit/{formato}/{poke}/{poke1}", name="pokemon_tiene_partner_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato, Pokemon $poke, Pokemon $poke1): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTienePartner = $em->getRepository(PokemonTienePartner::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$poke1->getIdpoke());
        $hola = $pokemonTienePartner[0];

        $form = $this->createForm(PokemonTienePartnerType::class, $hola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pokemon_tiene_partner_index');
        }

        return $this->render('pokemon_tiene_partner/edit.html.twig', [
            'pokemon_tiene_partner' => $pokemonTienePartner,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

    /**
     * @Route("/delete/{formato}/{poke}/{poke1}", name="pokemon_tiene_partner_delete", methods={"DELETE"})
     */
    public function delete(Formato $formato, Pokemon $poke, Pokemon $poke1): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTienePartner = $em->getRepository(PokemonTienePartner::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$poke1->getIdpoke());
        $hola = $pokemonTienePartner[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('pokemon_tiene_partner_index');
    }

    /**
     * @Route("/borrar/{formato}/{poke}/{poke1}", name="pokemon_tiene_partner_borrar", methods={"DELETE"})
     */
    public function borrar(Formato $formato, Pokemon $poke, Pokemon $poke1): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTienePartner = $em->getRepository(PokemonTienePartner::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$poke1->getIdpoke());
        $hola = $pokemonTienePartner[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('poke_show', [
            'idpoke' => $poke->getIdpoke(),
            'format' => $formato->getId()
        ]);
    }
}
