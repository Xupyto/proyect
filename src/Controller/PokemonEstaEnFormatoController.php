<?php

namespace App\Controller;

use App\Entity\PokemonEstaEnFormato;
use App\Entity\Formato;
use App\Entity\Pokemon;
use App\Form\PokemonEstaEnFormatoType;
use App\Repository\Pokemon_esta_en_formatoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pokemon/esta/en/formato")
 */
class PokemonEstaEnFormatoController extends AbstractController
{
    /**
     * @Route("/", name="pokemon_esta_en_formato_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, Pokemon_esta_en_formatoRepository $pokemon_esta_en_formatoRepository): Response
    {

        $objetos = $pokemon_esta_en_formatoRepository->findAll();

        $pagination = $paginator->paginate(
            $objetos,
            $request->query->getInt("page", 1),
            10
        );

        return $this->render('pokemon_esta_en_formato/index.html.twig', [
            'pokemon_esta_en_formatos' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="pokemon_esta_en_formato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokemonEstaEnFormato = new PokemonEstaEnFormato();
        $form = $this->createForm(PokemonEstaEnFormatoType::class, $pokemonEstaEnFormato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemonEstaEnFormato);
            $entityManager->flush();

            return $this->redirectToRoute('pokemon_esta_en_formato_index');
        }

        return $this->render('pokemon_esta_en_formato/new.html.twig', [
            'pokemon_esta_en_formato' => $pokemonEstaEnFormato,
            'form' => $form->createView(),
        ]);
    }

  
    /**
     * @Route("/edit/{formato}/{poke}", name="pokemon_esta_en_formato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formato $formato, Pokemon $poke): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonEstaEnFormato = $em->getRepository(PokemonEstaEnFormato::class)->findByManyFields($formato->getId(),$poke->getIdpoke());
        $hola = $pokemonEstaEnFormato[0];
        $form = $this->createForm(PokemonEstaEnFormatoType::class, $hola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pokemon_esta_en_formato_index');
        }

        return $this->render('pokemon_esta_en_formato/edit.html.twig', [
            'pokemon_esta_en_formato' => $pokemonEstaEnFormato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{formato}/{poke}", name="pokemon_esta_en_formato_delete", methods={"DELETE"})
     */
    public function delete(Formato $formato, Pokemon $poke): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pokemonEstaEnFormato = $em->getRepository(PokemonEstaEnFormato::class)->findByManyFields($formato->getId(),$poke->getIdpoke());
        $hola = $pokemonEstaEnFormato[0];
        
        $em->remove($hola);
        $em->flush();

        return $this->redirectToRoute('pokemon_esta_en_formato_index');
    }
}
