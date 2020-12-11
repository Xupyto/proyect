<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\EquipoContienePokemon;
use App\Entity\Objeto;
use App\Entity\Usuario;
use App\Entity\Pokemon;
use App\Entity\Habilidad;
use App\Entity\Movimiento;
use App\Entity\Spread;
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
    public function edicionBuild(PaginatorInterface $paginator, Request $request, Equipo $equipo){
        $session = $request->getSession();
        //Listar pokes para añadir al team
        $filtro = $request->get("nombre");
      
        if($filtro == null){
            $pokes = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findAll();
        } else {
            
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
        // Comprobar que se ha cambiado de edición de equipo
        if($session->get('idequipo') != $equipo->getidequipo())
        {
            $session->set('team', null);
        }
            $miembros = $this->getDoctrine()
                ->getRepository(EquipoContienePokemon::class)
                ->findById($equipo->getidequipo());
            //Creacion de arrays para visionado en plantilla de la matriz
            $pokes = [];
            $objs = [];   
            $habs = [];   
            $spreads = [];   
            $movs1 = [];   
            $movs2 = [];   
            $movs3 = [];   
            $movs4 = [];   
           
            $array = json_decode($session->get('team'));       
            //var_dump($array);     
                
            if($miembros != null && $array == null)
            {   
                $array = [];
               
                foreach ($miembros as $equipocontpoke) {
                    $arraypoke = [];
                // Buscamos la entidad concreta
                    $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($equipocontpoke->getPokemonIdpoke());
                    
                    $id = $equipocontpoke->getObjeto();
                    if($id != null)
                    {
                        $objeto = $this->getDoctrine()
                        ->getRepository(Objeto::class)
                        ->find($id);

                    } else {
                        $objeto = null;
                    }
                   
                    $id = $equipocontpoke->getHabilidad();
                    if($id != null)
                    {
                        $habilidad = $this->getDoctrine()
                        ->getRepository(Habilidad::class)
                        ->find($id);

                    } else {
                        $habilidad = null;
                    }
                    
                    $id = $equipocontpoke->getSpread();
                    if($id != null)
                    {
                        $spread = $this->getDoctrine()
                        ->getRepository(Spread::class)
                        ->find($id);

                    } else {
                        $spread = null;
                    }
                    
                    $id = $equipocontpoke->getMov1();
                    if($id != null)
                    {
                        $mov1 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($id);

                    } else {
                        $mov1 = null;
                    }
                    $id = $equipocontpoke->getMov2();
                    if($id != null)
                    {
                        $mov2 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($id);

                    } else {
                        $mov2 = null;
                    }
                    $id = $equipocontpoke->getMov3();
                    if($id != null)
                    {
                        $mov3 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($id);

                    } else {
                        $mov3 = null;
                    }
                    $id = $equipocontpoke->getMov4();
                    if($id != null)
                    {
                        $mov4 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($id);

                    } else {
                        $mov4 = null;
                    }
                    
                   
                    
                 //Rellenamos los arrays con datos o huecos si no tiene nada a la vez que la matriz de datos al final con el array que vamos creando para cada poke
                    array_push($pokes, $poke);
                   
                    array_push($arraypoke, $poke[0]->getIdpoke());
                    
                    if($objeto != null)
                    {
                        array_push($objs, $objeto);
                        array_push($arraypoke, $objeto->getIdobjeto());
                       
                    } else {
                        array_push($objs, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }

                    if($habilidad != null)
                    {
                        array_push($habs, $habilidad);
                        array_push($arraypoke, $habilidad->getIdhabilidad());
                    } else {
                        array_push($habs, "Ninguna");
                        array_push($arraypoke, "Ninguna");
                    }

                    if($spread != null)
                    {
                        array_push($spreads, $spread);
                        array_push($arraypoke, $spread->getIdspread());
                    } else {
                        array_push($spreads, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }

                    if($mov1 != null)
                    {
                        array_push($movs1, $mov1);
                        array_push($arraypoke, $mov1->getIdMov());
                    } else {
                        array_push($movs1, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }

                    if($mov2 != null)
                    {
                        array_push($movs2, $mov2);
                        array_push($arraypoke, $mov2->getIdMov());
                    } else {
                        array_push($movs2, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }

                    if($mov3 != null)
                    {
                        array_push($movs3, $mov3);
                        array_push($arraypoke, $mov3->getIdMov());
                    } else {
                        array_push($movs3, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }

                    if($mov4 != null)
                    {
                        array_push($movs4, $mov4);
                        array_push($arraypoke, $mov4->getIdMov());
                    } else {
                        array_push($movs4, "Ninguno");
                        array_push($arraypoke, "Ninguno");
                    }
                   
                    
                    array_push($array, $arraypoke);
                    
                }
               
                $session->set('team', json_encode($array));
                $session->set('idequipo', $equipo->getidequipo());
                

                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => $pokes,
                    'objs' => $objs,
                    'habs' => $habs,
                    'spreads' => $spreads,
                    'movs1' => $movs1,
                    'movs2' => $movs2,
                    'movs3' => $movs3,
                    'movs4' => $movs4
                ]);

             //En caso de que exista la matriz de datos creamos los arrays de objetos       
             
            } elseif ($array != null) {
                foreach ($array as $miembro) {
        
                    $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($miembro[0]);
                    
                    $objeto = $this->getDoctrine()
                        ->getRepository(Objeto::class)
                        ->find($miembro[1]);  
                    
                    $habilidad = $this->getDoctrine()
                        ->getRepository(Habilidad::class)
                        ->find($miembro[2]);

                    $spread = $this->getDoctrine()
                        ->getRepository(Spread::class)
                        ->find($miembro[3]);
                    
                    $mov1 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($miembro[4]);

                    $mov2 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($miembro[5]);
                    
                    $mov3 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($miembro[6]);

                    $mov4  = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($miembro[7]);
                    
                    array_push($pokes, $poke);
                    if($objeto != null)
                    {
                        array_push($objs, $objeto);
                       
                    } else {
                        array_push($objs, "Ninguno");
                    }

                    if($habilidad != null)
                    {
                        array_push($habs, $habilidad);
                       
                    } else {
                        array_push($habs, "Ninguna");
                        
                    }

                    if($spread != null)
                    {
                        array_push($spreads, $spread);
                       
                    } else {
                        array_push($spreads, "Ninguno");
                        
                    }

                    if($mov1 != null)
                    {
                        array_push($movs1, $mov1);
                       
                    } else {
                        array_push($movs1, "Ninguno");
                       
                    }

                    if($mov2 != null)
                    {
                        array_push($movs2, $mov2);
                       
                    } else {
                        array_push($movs2, "Ninguno");
                       
                    }

                    if($mov3 != null)
                    {
                        array_push($movs3, $mov3);
                        
                    } else {
                        array_push($movs3, "Ninguno");
                        
                    }

                    if($mov4 != null)
                    {
                        array_push($movs4, $mov4);
                        
                    } else {
                        array_push($movs4, "Ninguno");
                        
                    }
                }
               
                $session->set('idequipo', $equipo->getidequipo());
            
                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => $pokes,
                    'objs' => $objs,
                    'habs' => $habs,
                    'spreads' => $spreads,
                    'movs1' => $movs1,
                    'movs2' => $movs2,
                    'movs3' => $movs3,
                    'movs4' => $movs4
                ]);
            } else {
                
                $session->set('idequipo', $equipo->getidequipo());
                return $this->render('build/crearteam.html.twig', [
                    'equipo' => $equipo,
                    'pokes' => $pagination,
                    'team' => null,
                    'objs' => null,
                    'habs' => null,
                    'spreads' => null,
                    'movs1' => null,
                    'movs2' => null,
                    'movs3' => null,
                    'movs4' => null
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
        foreach($array as $poke)
        {
            if($poke[0] == $id)
            {
                $existe = true;
            }
        }
        
        if($existe == false && sizeof($array) < 6)
        {
            $new = [$id,"Ninguno","Ninguna","Ninguno","Ninguno","Ninguno","Ninguno","Ninguno"];
            array_push($array, $new);
           
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
        
        $id = json_decode($request->getContent());
        
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($id == $array[$i][0]) {
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
            
            foreach ($array as $equipocontpoke ) {
                
                $eq = new EquipoContienePokemon();

                $poke = $this->getDoctrine()
                        ->getRepository(Pokemon::class)
                        ->findById($equipocontpoke[0]);
                $eq->setPokemonIdpoke($poke[0]);

                $eq->setEquipoIdequipo($team);
                if($equipocontpoke[1] != "Ninguno")
                {
                    $objeto = $this->getDoctrine()
                        ->getRepository(Objeto::class)
                        ->find($equipocontpoke[1]);
                    $eq->setObjeto($objeto);
                }
                
                if($equipocontpoke[2] != "Ninguna")
                {
                    $habilidad = $this->getDoctrine()
                        ->getRepository(Habilidad::class)
                        ->find($equipocontpoke[2]);
                    $eq->setHabilidad($habilidad);
                }

                if($equipocontpoke[3] != "Ninguno")
                {
                    $spread = $this->getDoctrine()
                        ->getRepository(Spread::class)
                        ->find($equipocontpoke[3]);
                    $eq->setSpread($spread);
                }

                if($equipocontpoke[4] != "Ninguno")
                {
                    $mov1 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($equipocontpoke[4]);
                    $eq->setMov1($mov1);
                }

                if($equipocontpoke[5] != "Ninguno")
                {
                    $mov2 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($equipocontpoke[5]);
                    $eq->setMov2($mov2);
                }

                if($equipocontpoke[6] != "Ninguno")
                {
                    $mov3 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($equipocontpoke[6]);
                    $eq->setMov3($mov3);
                }

                if($equipocontpoke[7] != "Ninguno")
                {
                    $mov4 = $this->getDoctrine()
                        ->getRepository(Movimiento::class)
                        ->find($equipocontpoke[7]);
                    $eq->setMov4($mov4);
                }

                $entityManager->persist($eq);
                $entityManager->flush();
                
            }
        }
  
        return $this->redirectToRoute('vaciar_team');
    }

    /** 
     * @Route("/build/anadido/obj/{idequipo}/{idpoke}", name = "add_obj")
     *
     * 
     * @return void
     */
    public function addObjeto(Request $request, Pokemon $poke, Equipo $eq): Response
    {
       
        $objeto = $request->get("obj");
        $array = json_decode($this->session->get('team'));
        $estacogido = false;
        
        if($objeto != null && $objeto != ""){
  
            for($i=0;$i<sizeof($array);$i++)
            {
                if($array[$i][1] == intval($objeto))
                {
                    $estacogido = true;
                    
                } 
            }
            for($i=0;$i<sizeof($array);$i++)
            {
                if ($array[$i][0] == $poke->getIdpoke() && $estacogido == false)
                {
                    $array[$i][1] = intval($objeto);
                }
            }
            
        }
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }

    /** 
     * @Route("/build/eliminado/obj/{idequipo}/{idpoke}", name = "remove_obj")
     *
     * 
     * @return void
     */
    public function removeObjeto(Pokemon $poke, Equipo $eq): Response
    {
       
        $array = json_decode($this->session->get('team'));
        
        
        for($i=0;$i<sizeof($array);$i++)
        {
            if($array[$i][0] == $poke->getIdpoke())
            {
                $array[$i][1] = "Ninguno";
            }
        }
            
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }

    /** 
     * @Route("/build/anadido/hab/{idequipo}/{idpoke}", name = "add_hab")
     *
     * 
     * @return void
     */
    public function addHabilidad(Request $request, Pokemon $poke, Equipo $eq): Response
    {
       
        $habilidad = $request->get("hab");
        $array = json_decode($this->session->get('team'));
        
        if($habilidad != null && $habilidad != ""){
  
            for($i=0;$i<sizeof($array);$i++)
            {
                if($array[$i][0] == $poke->getIdpoke())
                {
                    $array[$i][2] = intval($habilidad);
                }
            }
            
        }
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }
    /** 
     * @Route("/build/eliminado/hab/{idequipo}/{idpoke}", name = "remove_hab")
     *
     * 
     * @return void
     */
    public function removeHabilidad(Pokemon $poke, Equipo $eq): Response
    {
       
        $array = json_decode($this->session->get('team'));
        
        
        for($i=0;$i<sizeof($array);$i++)
        {
            if($array[$i][0] == $poke->getIdpoke())
            {
                $array[$i][2] = "Ninguna";
            }
        }
            
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }
    /** 
     * @Route("/build/anadido/spread/{idequipo}/{idpoke}", name = "add_spread")
     *
     * 
     * @return void
     */
    public function addSpread(Request $request, Pokemon $poke, Equipo $eq): Response
    {
       
        $spread = $request->get("spread");
        $array = json_decode($this->session->get('team'));
        
        if($spread != null && $spread != ""){
  
            for($i=0;$i<sizeof($array);$i++)
            {
                if($array[$i][0] == $poke->getIdpoke())
                {
                    $array[$i][3] = intval($spread);
                }
            }
            
        }
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }
    /** 
     * @Route("/build/eliminado/spread/{idequipo}/{idpoke}", name = "remove_spread")
     *
     * 
     * @return void
     */
    public function removeSpread(Pokemon $poke, Equipo $eq): Response
    {
       
        $array = json_decode($this->session->get('team'));
        
        
        for($i=0;$i<sizeof($array);$i++)
        {
            if($array[$i][0] == $poke->getIdpoke())
            {
                $array[$i][3] = "Ninguno";
            }
        }
            
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }
    /** 
     * @Route("/build/anadido/mov/{idequipo}/{idpoke}/{n}", name = "add_mov")
     *
     * 
     * @return void
     */
    public function addMov(Request $request, Pokemon $poke, Equipo $eq, int $n): Response
    {
       
        $mov = $request->get("mov");
        $array = json_decode($this->session->get('team'));
        
        if($mov != null && $mov != ""){
  
            for($i=0;$i<sizeof($array);$i++)
            {
                if($array[$i][0] == $poke->getIdpoke())
                {
                    if($array[$i][4] != intval($mov) && $array[$i][5] != intval($mov) && $array[$i][6] != intval($mov) && $array[$i][7] != intval($mov))
                    {
                        $array[$i][$n+4] = intval($mov);
                    }
                   
                }
            }
            
        }
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }

    /** 
     * @Route("/build/eliminado/mov/{idequipo}/{idpoke}/{n}", name = "remove_mov")
     *
     * 
     * @return void
     */
    public function removeMov(Pokemon $poke, Equipo $eq, int $n): Response
    {
       
        $array = json_decode($this->session->get('team'));
        
        
        for($i=0;$i<sizeof($array);$i++)
        {
            if($array[$i][0] == $poke->getIdpoke())
            {
                $array[$i][$n+4] = "Ninguno";
            }
        }
            
        
        $this->session->set('team', json_encode($array));

        return $this->redirectToRoute('build_pokes', [
            'idequipo' => $eq->getidequipo()
        ]);
    }

}
