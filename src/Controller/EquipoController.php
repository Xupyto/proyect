<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\EquipoContienePokemon;
use App\Entity\Usuario;
use App\Entity\Pokemon;
use App\Form\EquipoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/equipo")
 */
class EquipoController extends AbstractController
{
    private $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="equipo_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $equipos = $this->getDoctrine()
            ->getRepository(Equipo::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $equipos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('equipo/index.html.twig', [
            'equipos' => $pagination,
        ]);
    }

    

    /**
     * @Route("/new", name="equipo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipo);
            $entityManager->flush();

            return $this->redirectToRoute('equipo_index');
        }

        return $this->render('equipo/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/{idequipo}/edit", name="equipo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipo $equipo): Response
    {
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipo_index');
        }

        return $this->render('equipo/edit.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idequipo}", name="equipo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Equipo $equipo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipo->getIdequipo(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipo_index');
    }

    /**
     * @Route("/builder", name="build_index", methods={"GET"})
     *
     * @return void
     */
    public function teamBuild(PaginatorInterface $paginator, Request $request){

        $email = $_SESSION['_sf2_attributes']['_security.last_username'];

        $em = $this->getDoctrine()->getManager();
        $equipos = $em->getRepository(Equipo::class)->findByEmail($email);

        $pagination = $paginator->paginate(
            $equipos,
            $request->query->getInt("page", 1),
            10
        );
        
        return $this->render('build/index.html.twig', [
            'equipos' => $pagination
        ]);
    }

    /**
     * @Route("/builder/new", name="build_new", methods={"GET","POST"})
     */
    public function newBuild(Request $request): Response
    {
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $email = $_SESSION['_sf2_attributes']['_security.last_username'];
            $usu = $entityManager->getRepository(Usuario::class)->findById($email);
            $equipo->setUsuarioEmail($usu[0]);
            $entityManager->persist($equipo);
            $entityManager->flush();

            return $this->redirectToRoute('build_index');
        }

        return $this->render('build/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/builder/{idequipo}/edit", name="build_edit", methods={"GET","POST"})
     */
    public function editBuild(Request $request, Equipo $equipo): Response
    {
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('build_index');
        }

        return $this->render('build/edit.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/builder/{idequipo}", name="build_delete", methods={"DELETE"})
     */
    public function deleteBuild(Request $request, Equipo $equipo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipo->getIdequipo(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('build_index');
    }

    /**
     * @Route("/builder/edicion/{idequipo}", name="build_pokes", methods={"GET","POST"})
     */
    public function edicionBuild(PaginatorInterface $paginator, Request $request, Equipo $equipo, string $filtro=null){
        //Listar pokes para añadir al team
        if($filtro == null){
            $pokes = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findAll();
        } else {
            $session = $request->getSession();
            $session->set('filtro', $filtro);

            $pokes = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findByName($filtro);
        }

            $pagination = $paginator->paginate(
                $pokes,
                $request->query->getInt("page", 1),
                5
            );

            $miembros = $this->getDoctrine()
                ->getRepository(EquipoContienePokemon::class)
                ->findById($equipo->getidequipo());

                $pokes = [];
                

                $array = json_decode($this->session->get('team'));
                var_dump($array);
            if($miembros != null && $array == null)
            {   
                $array = [];
                foreach ($miembros as $equipocontpoke) {
        
                    $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($equipocontpoke->getPokemonIdpoke());
                    
                    array_push($pokes, $poke);
                    array_push($array, $poke[0]->getIdpoke());
                }

                $this->session->set('team', json_encode($array));

                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => $pokes
                ]);

                    
             
            } elseif ($array != null) {
                foreach ($array as $id) {
        
                    $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($id);
                    
                    array_push($pokes, $poke);
                }
                
            
                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => $pokes
                ]);
            } else {
                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => null
                ]);
            }
    }

    

    /**
     * @Route("/build/anadido", name = "add_team")
     *
     * 
     * @return void
     */
    public function addTeam(Request $request): Response
    {
        $team = $this->session->get('team');
        $array = null;

        if ($team == null) {
            $array = [];
        } else {
            $array = json_decode($team);
        }

        $id = json_decode($request->getContent());
        $existe = false;
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($id == $array[$i]) {
               $existe = true;
            }
        }
        if($existe == false && sizeof($array) < 6)
        {
            array_push($array, $id);
        }

        $this->session->set('team', json_encode($array));

        return new JsonResponse($array);
    }

    /**
     * @Route("/build/eliminado", name="eliminar_poke")
     *
     * @return void
     */
    public function eliminar_poke(Request $request)
    {
        $array = json_decode($this->session->get('team'));
        var_dump($array);
        $id = json_decode($request->getContent());

        for ($i = 0; $i < sizeof($array); $i++) {
            if ($id == $array[$i]) {
                array_splice($array, $i, 1);
                $i--;
            }
        }

        $this->session->set('team', json_encode($array));

        return new JsonResponse($array);
    }

    /**
     * @Route("/vaciar", name="vaciar_team")
     *
     * @return void
     */
    public function vaciarTeam()
    {
        $this->session->set('team', null);

        return $this->redirectToRoute('build_index');
    }

    /**
     * @Route("/build/guardar/{idequipo}", name="guardar_build")
     *
     * @return void
     */
    public function guardarTeam(Equipo $team)
    {
        
        $array = json_decode($this->session->get('team'));
        if ($array != null) {
            $miembros = $this->getDoctrine()
            ->getRepository(EquipoContienePokemon::class)
            ->findById($team->getidequipo());

            $entityManager = $this->getDoctrine()->getManager();
            foreach ($miembros as $miembro)
            {
                $entityManager->remove($miembro);
                $entityManager->flush();
            }
           
            foreach ($array as $id ) {
                
                $eq = new EquipoContienePokemon();
                $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($id);
                $eq->setPokemonIdpoke($poke[0]);
                $eq->setEquipoIdequipo($team);
               
                $entityManager->persist($eq);
                $entityManager->flush();
                
            }
        }
  
        return $this->redirectToRoute('vaciar_team');
    }
}
