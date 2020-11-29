<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Formato;
use App\Entity\PokemonEstaEnFormato;
use App\Entity\PokemonTienePartner;
use App\Entity\PokemonTieneSpread;
use App\Entity\PokePuedeAprenderMov;
use App\Entity\PokeTieneHabilidad;
use App\Entity\PokeUsaObj;
use App\Form\PokeType;
use App\Form\PokePuedeAprenderMovType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class PokeController extends AbstractController
{

    /**
     * @Route("/", name="poke_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
            
            $pokes = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $pokes,
                $request->query->getInt("page", 1),
                10
            );

            return $this->render('poke/inicio.html.twig', [
                'pokes' => $pagination,
            ]);
    }
    /**
     * 
     * @Route("/filtroformato", name="filtrar_formato", methods={"GET","POST"})
     */
    public function index_filtro(PaginatorInterface $paginator, Request $request)
    {
        $session = $request->getSession();
        $filtro = $request->get("format");

        if($filtro != null){
            $session->set('filtro', $filtro);
        }
       

        $em = $this->getDoctrine()->getManager();
        $pokemons = $em->getRepository(PokemonEstaEnFormato::class)->findByIdFormat($session->get('filtro'));
        $format = $em->getRepository(Formato::class)->findById($session->get('filtro'));
        
        $mensaje = "Formato ".$pokemons[0]->getFormato()->getNombre();
        $pokes = [];
        foreach ( $pokemons as $pokeisformat)
        {
            $pokes [] = $pokeisformat->getPokemonIdpoke();
        }

        $porcentajes = [];
    
        for($i = 0; $i<sizeof($pokes);$i++){
            $porcentajes []= $em->getRepository(PokemonEstaEnFormato::class)->findById($pokes[$i]->getIdpoke());
        }

        $pagination = $paginator->paginate(
            $pokes,
            $request->query->getInt("page", 1),
            5
        );
       

        return $this->render('poke/index.html.twig', [
            'pokes' => $pagination,
            'porcentajes' => $porcentajes,
            'filtro' => $mensaje,
            'format' => $format
        ]);
    }

    public function filtro_formato()
    {
        $em = $this->getDoctrine()->getManager();
        $formatos = $em->getRepository(Formato::class)->findAll();

        return $this->render('shared/filtroformato.html.twig', ["formatos" => $formatos]);
    }
    



    /**
     * @Route("/new", name="poke_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $poke = new Pokemon();
        $form = $this->createForm(PokeType::class, $poke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $foto = $form['Fileimg']->getData();
            if ($foto) {
                $nombrearchivo = $foto->getClientOriginalName();
                $foto->move(
                    $this->getParameter('directorio_imagenes'),
                    $nombrearchivo
                );
                $poke->setFoto($nombrearchivo);
            }
            //Rellenamos la tabla pokemon y pokemon tiene tipo
            $poke->addTipoNombre($form['tipo1']->getData());

            if($form['tipo2']->getData() != null){
                $poke->addTipoNombre($form['tipo2']->getData());
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poke);
            $entityManager->flush();
            //Rellenamos la tabla pokemon tiene formato
            $pokeisformat = new PokemonEstaEnFormato();
            $pokeisformat->setFormato($form['formato']->getData());
            $pokeisformat->setPokemonIdpoke($poke);
            $pokeisformat->setPorcentajeUso($form['porcentajeuso']->getData());

            $entityManager->persist($pokeisformat);
            $entityManager->flush();

            return $this->redirectToRoute('poke_index');
        }

        return $this->render('poke/new.html.twig', [
            'poke' => $poke,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{idpoke}", name="poke_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pokemon $poke): Response
    {
        
        $form = $this->createForm(PokeType::class, $poke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $foto = $form['Fileimg']->getData();
            if ($foto) {
                $nombrearchivo = $foto->getClientOriginalName();
                $foto->move(
                    $this->getParameter('directorio_imagenes'),
                    $nombrearchivo
                );
                $poke->setFoto($nombrearchivo);
            }
            //Rellenamos la tabla pokemon y pokemon tiene tipo
            $poke->addTipoNombre($form['tipo1']->getData());

            if($form['tipo2']->getData() != null){
                $poke->addTipoNombre($form['tipo2']->getData());
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poke);
            $entityManager->flush();
            //Rellenamos la tabla pokemon tiene formato
            $pokeisformat = new PokemonEstaEnFormato();
            $pokeisformat->setFormato($form['formato']->getData());
            $pokeisformat->setPokemonIdpoke($poke);
            $pokeisformat->setPorcentajeUso($form['porcentajeuso']->getData());

            $entityManager->persist($pokeisformat);
            $entityManager->flush();

            return $this->redirectToRoute('poke_index');
        }
    
        return $this->render('poke/edit.html.twig', [
            'poke' => $poke,
            'form' => $form->createView(),
        ]);
    }

   
    
    /**
     * @Route("/{idpoke}", name="pokemon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pokemon $pokemon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemon->getIdpoke(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('poke_index');
    }

    /**
     * @Route("/{idpoke}/edit/{format}", name="anadir_mov", methods={"GET","POST"})
     */
    public function anadirmov(Request $request, Pokemon $poke, Formato $format): Response
    {
       
        $pokePuedeAprenderMov = new PokePuedeAprenderMov();
        $pokePuedeAprenderMov->setPokemonIdpoke($poke);
        $pokePuedeAprenderMov->setFormato($format);
        
        $form = $this->createForm(PokePuedeAprenderMovType::class, $pokePuedeAprenderMov);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $pokePuedeAprenderMov->setPokemonIdpoke($poke);
            $pokePuedeAprenderMov->setFormato($format);
            $entityManager = $this->getDoctrine()->getManager();
            var_dump($pokePuedeAprenderMov);
            $entityManager->persist($pokePuedeAprenderMov);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        $blocked = true;
        return $this->render('poke_puede_aprender_mov/new.html.twig', [
            'poke_puede_aprender_mov' => $pokePuedeAprenderMov,
            'form' => $form->createView(),
            'blocked' => $blocked
        ]);
    }

    /**
     * @Route("/pokedex/{idpoke}/{format}", name="poke_show", methods={"GET"}) 
     * 
     * @Route("/pokedex/{idpoke}", name="poke_show_in", methods={"GET"}) 
     *  
     */
    public function showPoke(Pokemon $poke, Formato $format=null ): Response
    {
        
        $estadisticas = [];
        array_push($estadisticas, $poke->getHp(), $poke->getAtq(), $poke->getDef(), $poke->getSpa(), $poke->getSpd(), $poke->getVel());
        sort($estadisticas);
        $mayor = $estadisticas[5];

         $em = $this->getDoctrine()->getManager();
         $ataques = $em->getRepository(PokePuedeAprenderMov::class)->findById($poke->getIdpoke());
         $objetos = $em->getRepository(PokeUsaObj::class)->findById($poke->getIdpoke());
         $habilidades = $em->getRepository(PokeTieneHabilidad::class)->findById($poke->getIdpoke());
         $companeros = $em->getRepository(PokemonTienePartner::class)->findById($poke->getIdpoke());
         $spreads = $em->getRepository(PokemonTieneSpread::class)->findById($poke->getIdpoke());
        
        
        return $this->render('shared/contenido.html.twig', [
            'pokemon' => $poke,
            'mayor' => $mayor,
            'ataques' => $ataques,
            'objetos' => $objetos,
            'habilidades' => $habilidades,
            'companeros' => $companeros,
            'spreads' => $spreads,
            'format' => $format
        ]);
        
    }
}
