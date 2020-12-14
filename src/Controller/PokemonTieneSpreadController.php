<?php

namespace App\Controller;

use App\Entity\PokemonTieneSpread;
use App\Entity\Pokemon;
use App\Entity\Spread;
use App\Entity\Formato;
use App\Form\PokemonTieneSpreadType;
use App\Repository\PokemonTieneSpreadRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pokemon/tiene/spread")
 */
class PokemonTieneSpreadController extends AbstractController
{
    /**
     * @Route("/", name="pokemon_tiene_spread_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request,PokemonTieneSpreadRepository $pokemonTieneSpreadRepository): Response
    {
        $objetos = $pokemonTieneSpreadRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );

        return $this->render('pokemon_tiene_spread/index.html.twig', [
            'pokemon_tiene_spreads' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="pokemon_tiene_spread_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokemonTieneSpread = new PokemonTieneSpread();
        $form = $this->createForm(PokemonTieneSpreadType::class, $pokemonTieneSpread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemonTieneSpread);
            $entityManager->flush();

            return $this->redirectToRoute('pokemon_tiene_spread_index');
        }

        return $this->render('pokemon_tiene_spread/new.html.twig', [
            'pokemon_tiene_spread' => $pokemonTieneSpread,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

    /**
     * @Route("/edit/{formato}/{poke}/{spread}", name="pokemon_tiene_spread_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato, Pokemon $poke, Spread $spread): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTieneSpread = $em->getRepository(PokemonTieneSpread::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$spread->getIdspread());
        $hola = $pokemonTieneSpread[0];

        $form = $this->createForm(PokemonTieneSpreadType::class, $hola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pokemon_tiene_spread_index');
        }

        return $this->render('pokemon_tiene_spread/edit.html.twig', [
            'pokemon_tiene_spread' => $hola,
            'form' => $form->createView(),
            'blocked' => false
        ]);
    }

    /**
     * @Route("/delete/{formato}/{poke}/{spread}", name="pokemon_tiene_spread_delete", methods={"DELETE"})
     */
    public function delete(Formato $formato, Pokemon $poke, Spread $spread): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTieneSpread = $em->getRepository(PokemonTieneSpread::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$spread->getIdspread());
        $hola = $pokemonTieneSpread[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('pokemon_tiene_spread_index');
    }

    /**
     * @Route("/borrar/{formato}/{poke}/{spread}", name="pokemon_tiene_spread_borrar", methods={"DELETE"})
     */
    public function borrar(Formato $formato, Pokemon $poke, Spread $spread): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonTieneSpread = $em->getRepository(PokemonTieneSpread::class)->findByManyFields($formato->getId(),$poke->getIdpoke(),$spread->getIdspread());
        $hola = $pokemonTieneSpread[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('poke_show', [
            'idpoke' => $poke->getIdpoke(),
            'format' => $formato->getId()
        ]);
    }
}
