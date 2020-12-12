<?php

namespace App\Controller;

use App\Entity\Campeonato;
use App\Entity\Jugador;
use App\Entity\Pokemon;
use App\Entity\JugadorPokesCampeonato;
use App\Form\JugadorPokesCampeonatoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/jugador/pokes/campeonato")
 */
class JugadorPokesCampeonatoController extends AbstractController
{
    /**
     * @Route("/", name="jugador_pokes_campeonato_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $jugadorPokesCampeonatos = $this->getDoctrine()
            ->getRepository(JugadorPokesCampeonato::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $jugadorPokesCampeonatos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('jugador_pokes_campeonato/index.html.twig', [
            'jugador_pokes_campeonatos' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="jugador_pokes_campeonato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jugadorPokesCampeonato = new JugadorPokesCampeonato();
        $form = $this->createForm(JugadorPokesCampeonatoType::class, $jugadorPokesCampeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $jugadorPokesCampeonato->setHabilidad($form['habilidad']->getData());
            var_dump($form['habilidad']->getData());

            $entityManager->persist($jugadorPokesCampeonato);
            $entityManager->flush();

            return $this->redirectToRoute('jugador_pokes_campeonato_index');
        }

        return $this->render('jugador_pokes_campeonato/new.html.twig', [
            'jugador_pokes_campeonato' => $jugadorPokesCampeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{campeonato}/{jugador}/{poke}", name="jugador_pokes_campeonato_show", methods={"GET"})
     */
    public function show(Campeonato $campeonato, Jugador $jugador, Pokemon $poke): Response
    {
        
        $em = $this->getDoctrine()->getManager();
        $jugadorPokesCampeonato = $em->getRepository(JugadorPokesCampeonato::class)->findByManyFields($campeonato->getIdcampeonato(),$jugador->getIdjugador(),$poke->getIdpoke());
        $n = $jugadorPokesCampeonato[0];
        return $this->render('jugador_pokes_campeonato/show.html.twig', [
            'jugador_pokes_campeonato' => $n,
        ]);
    }

    /**
     * @Route("/edit/{campeonato}/{jugador}/{poke}", name="jugador_pokes_campeonato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campeonato $campeonato, Jugador $jugador, Pokemon $poke): Response
    {
        $em = $this->getDoctrine()->getManager();
        $jugadorPokesCampeonato = $em->getRepository(JugadorPokesCampeonato::class)->findByManyFields($campeonato->getIdcampeonato(),$jugador->getIdjugador(),$poke->getIdpoke());
        $n = $jugadorPokesCampeonato[0];
        $form = $this->createForm(JugadorPokesCampeonatoType::class, $n);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jugador_pokes_campeonato_index');
        }

        return $this->render('jugador_pokes_campeonato/edit.html.twig', [
            'jugador_pokes_campeonato' => $jugadorPokesCampeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{campeonato}/{jugador}/{poke}", name="jugador_pokes_campeonato_delete", methods={"DELETE"})
     */
    public function delete(Campeonato $campeonato, Jugador $jugador, Pokemon $poke): Response
    {
        $em = $this->getDoctrine()->getManager();
        $jugadorPokesCampeonato = $em->getRepository(JugadorPokesCampeonato::class)->findByManyFields($campeonato->getIdcampeonato(),$jugador->getIdjugador(),$poke->getIdpoke());
        $n = $jugadorPokesCampeonato[0];

        $em->remove($n);
        $em->flush();
        return $this->redirectToRoute('jugador_pokes_campeonato_index');
    }


    /**
     * @Route("/filtroformato", name="filtro_format_torneo", methods={"GET","POST"})
     */
    public function filtrar_formato(Request $request): Response
    {
        $filtro = $request->get("format");

        if($filtro == null)
        {
            $filtro = 1;
        }
        $campeonatos = $this->getDoctrine()->getManager()->getRepository(Campeonato::class)->findByFormat($filtro);

        
        return $this->render('shared/Torneos.html.twig',[
            'camps' => $campeonatos
        ]);
    } 
    /**
     * @Route("/participantes/{campeonato}", name="ver_participantes", methods={"GET","POST"})
     */
    public function verParticipantes(Campeonato $campeonato): Response
    {
        
        $participantes = $this->getDoctrine()->getManager()->getRepository(JugadorPokesCampeonato::class)->findPlayersbyCamp($campeonato->getIdcampeonato());
        $jugadores = [];
       
        foreach($participantes as $part)
        {
            $existe = false;
            foreach($jugadores as $j)
            {
                if($j->getIdjugador() == $part->getJugadorIdjugador()->getIdjugador())
                {
                    $existe = true;
                }
            }
           if($existe == false)
           {
               $jugadores[] = $part->getJugadorIdjugador();
           } 
        }
        return $this->render('shared/Participantes.html.twig',[
            'equipos' => $participantes,
            'jugadores' => $jugadores
        ]);
        
    } 
}
