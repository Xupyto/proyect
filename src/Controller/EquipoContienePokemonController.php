<?php

namespace App\Controller;

use App\Entity\EquipoContienePokemon;
use App\Form\EquipoContienePokemonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipo/contiene/pokemon")
 */
class EquipoContienePokemonController extends AbstractController
{
    /**
     * @Route("/", name="equipo_contiene_pokemon_index", methods={"GET"})
     */
    public function index(): Response
    {
        $equipoContienePokemons = $this->getDoctrine()
            ->getRepository(EquipoContienePokemon::class)
            ->findAll();

        return $this->render('equipo_contiene_pokemon/index.html.twig', [
            'equipo_contiene_pokemons' => $equipoContienePokemons,
        ]);
    }

    /**
     * @Route("/new", name="equipo_contiene_pokemon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipoContienePokemon = new EquipoContienePokemon();
        $form = $this->createForm(EquipoContienePokemonType::class, $equipoContienePokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipoContienePokemon);
            $entityManager->flush();

            return $this->redirectToRoute('equipo_contiene_pokemon_index');
        }

        return $this->render('equipo_contiene_pokemon/new.html.twig', [
            'equipo_contiene_pokemon' => $equipoContienePokemon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{pokemonIdpoke}", name="equipo_contiene_pokemon_show", methods={"GET"})
     */
    public function show(EquipoContienePokemon $equipoContienePokemon): Response
    {
        return $this->render('equipo_contiene_pokemon/show.html.twig', [
            'equipo_contiene_pokemon' => $equipoContienePokemon,
        ]);
    }

    /**
     * @Route("/{pokemonIdpoke}/edit", name="equipo_contiene_pokemon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EquipoContienePokemon $equipoContienePokemon): Response
    {
        $form = $this->createForm(EquipoContienePokemonType::class, $equipoContienePokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipo_contiene_pokemon_index');
        }

        return $this->render('equipo_contiene_pokemon/edit.html.twig', [
            'equipo_contiene_pokemon' => $equipoContienePokemon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{pokemonIdpoke}", name="equipo_contiene_pokemon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EquipoContienePokemon $equipoContienePokemon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipoContienePokemon->getPokemonIdpoke(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipoContienePokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipo_contiene_pokemon_index');
    }
}
