<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Formato;
use App\Entity\Articulo;
use App\Entity\Equipo;
use App\Entity\PokemonEstaEnFormato;
use App\Entity\PokemonTienePartner;
use App\Entity\PokemonTieneSpread;
use App\Entity\PokePuedeAprenderMov;
use App\Entity\PokeTieneHabilidad;
use App\Entity\PokeUsaObj;
use App\Form\PokemonTienePartnerType;
use App\Form\PokeType;
use App\Form\PokePuedeAprenderMovType;
use App\Form\PokeUsaObjType;
use App\Form\PokeTieneHabilidadType;
use App\Form\PokemonTieneSpreadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Snappy\Pdf;


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
    public function index_filtroF(PaginatorInterface $paginator, Request $request)
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
     * @Route("/anadirobj/{idequipo}/{idpoke}", name="add_objeto_team", methods={"GET","POST"})
     *
     * @param Pokemon $poke
     * @return void
     */
    public function listadoObjetos(Pokemon $poke, Equipo $eq)
    {   
       
        $em = $this->getDoctrine()->getManager();
        $objs = $em->getRepository(PokeUsaObj::class)->findById($poke->getIdpoke());

        return $this->render('build/anadirobj.html.twig', [
            'objetos' => $objs,
            'poke' => $poke,
            'equipo' => $eq
        ]);
    }
    
    /**
     * @Route("/anadirhab/{idequipo}/{idpoke}", name="add_habilidad_team", methods={"GET","POST"})
     *
     * @param Pokemon $poke
     * @return void
     */
    public function listadoHabilidades(Pokemon $poke, Equipo $eq)
    {   
       
        $em = $this->getDoctrine()->getManager();
        $habs = $em->getRepository(PokeTieneHabilidad::class)->findById($poke->getIdpoke());

        return $this->render('build/anadirhab.html.twig', [
            'habilidades' => $habs,
            'poke' => $poke,
            'equipo' => $eq
        ]);
    }

    /**
     * @Route("/anadirspread/{idequipo}/{idpoke}", name="add_spread_team", methods={"GET","POST"})
     *
     * @param Pokemon $poke
     * @return void
     */
    public function listadoSpreads(Pokemon $poke, Equipo $eq)
    {   
       
        $em = $this->getDoctrine()->getManager();
        $spreads = $em->getRepository(PokemonTieneSpread::class)->findById($poke->getIdpoke());

        return $this->render('build/anadirspread.html.twig', [
            'spreads' => $spreads,
            'poke' => $poke,
            'equipo' => $eq
        ]);
    }

    /**
     * @Route("/anadirmov/{idequipo}/{idpoke}/{n}", name="add_mov_team", methods={"GET","POST"})
     *
     * @param Pokemon $poke
     * @return void
     */
    public function listadoMovimientos(Pokemon $poke, Equipo $eq, int $n)
    {   
       
        $em = $this->getDoctrine()->getManager();
        $movs = $em->getRepository(PokePuedeAprenderMov::class)->findById($poke->getIdpoke());

        return $this->render('build/anadirmov.html.twig', [
            'movs' => $movs,
            'poke' => $poke,
            'equipo' => $eq,
            'indicador' => $n
        ]);
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
            $poke->removeTipos();
            
            $poke->addTipoNombre($form['tipoNombre']->getData()[0]);
           

            if($form['tipoNombre']->getData()[1] != null){
                $poke->addTipoNombre($form['tipoNombre']->getData()[1]);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poke);
            $entityManager->flush();
            /*Rellenamos la tabla pokemon tiene formato
            $pokeisformat = new PokemonEstaEnFormato();
            $pokeisformat->setFormato($form['formato']->getData());
            $pokeisformat->setPokemonIdpoke($poke);
            $pokeisformat->setPorcentajeUso($form['porcentajeuso']->getData());

            $entityManager->persist($pokeisformat);
            $entityManager->flush();*/

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
            
            $poke->removeTipos();
            var_dump($form['tipoNombre']->getData());
            $poke->addTipoNombre($form['tipoNombre']->getData()[0]);
           

            if($form['tipoNombre']->getData()[1] != null){
                $poke->addTipoNombre($form['tipoNombre']->getData()[1]);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poke);
            $entityManager->flush();
            /*Rellenamos la tabla pokemon tiene formato
            $pokeisformat = new PokemonEstaEnFormato();
            $pokeisformat->setFormato($form['formato']->getData());
            $pokeisformat->setPokemonIdpoke($poke);
            $pokeisformat->setPorcentajeUso($form['porcentajeuso']->getData());

            $entityManager->persist($pokeisformat);
            $entityManager->flush();*/

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
     * @Route("/editmov/{idpoke}/{format}", name="anadir_mov", methods={"GET","POST"})
     */
    public function anadirMov(Request $request, Pokemon $poke, Formato $format): Response
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
            
            $entityManager->persist($pokePuedeAprenderMov);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        
        return $this->render('poke_puede_aprender_mov/new.html.twig', [
            'poke_puede_aprender_mov' => $pokePuedeAprenderMov,
            'form' => $form->createView(),
            'blocked' => true
        ]);
    }

    /**
     * @Route("/editobj/{idpoke}/{format}", name="anadir_obj", methods={"GET","POST"})
     */
    public function anadirObj(Request $request, Pokemon $poke, Formato $format): Response
    {
       
        $pokeusaobj = new PokeUsaObj();
        $pokeusaobj->setPokemonIdpoke($poke);
        $pokeusaobj->setFormato($format);
        
        $form = $this->createForm(PokeUsaObjType::class, $pokeusaobj);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $pokeusaobj->setPokemonIdpoke($poke);
            $pokeusaobj->setFormato($format);
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($pokeusaobj);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        
        return $this->render('poke_usa_obj/new.html.twig', [
            'poke_usa_obj' => $pokeusaobj,
            'form' => $form->createView(),
            'blocked' => true
        ]);
    }

    /**
     * @Route("/edithab/{idpoke}/{format}", name="anadir_hab", methods={"GET","POST"})
     */
    public function anadirHab(Request $request, Pokemon $poke, Formato $format): Response
    {
       
        $poketienehab = new PokeTieneHabilidad();
        $poketienehab->setPokemonIdpoke($poke);
        $poketienehab->setFormato($format);
        
        $form = $this->createForm(PokeTieneHabilidadType::class, $poketienehab);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $poketienehab->setPokemonIdpoke($poke);
            $poketienehab->setFormato($format);
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($poketienehab);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        
        return $this->render('poke_tiene_habilidad/new.html.twig', [
            'poke_tiene_habilidad' => $poketienehab,
            'form' => $form->createView(),
            'blocked' => true
        ]);
    }

    /**
     * @Route("/editspre/{idpoke}/{format}", name="anadir_spread", methods={"GET","POST"})
     */
    public function anadirSpread(Request $request, Pokemon $poke, Formato $format): Response
    {
       
        $poketienespread = new PokemonTieneSpread();
        $poketienespread->setPokemonIdpoke($poke);
        $poketienespread->setFormato($format);
        
        $form = $this->createForm(PokemonTieneSpreadType::class, $poketienespread);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $poketienespread->setPokemonIdpoke($poke);
            $poketienespread->setFormato($format);
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($poketienespread);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        
        return $this->render('pokemon_tiene_spread/new.html.twig', [
            'pokemon_tiene_spread' => $poketienespread,
            'form' => $form->createView(),
            'blocked' => true
        ]);
    }

    /**
     * @Route("/editpart/{idpoke}/{format}", name="anadir_partner", methods={"GET","POST"})
     */
    public function anadirPartner(Request $request, Pokemon $poke, Formato $format): Response
    {
       
        $poketienepartner = new PokemonTienePartner();
        $poketienepartner->setPokemonIdpoke($poke);
        $poketienepartner->setFormato($format);
        
        $form = $this->createForm(PokemonTienePartnerType::class, $poketienepartner);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $poketienepartner->setPokemonIdpoke($poke);
            $poketienepartner->setFormato($format);
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($poketienepartner);
            $entityManager->flush();

            return $this->redirectToRoute('poke_show', [
                'idpoke' => $poke->getIdpoke(),
                'format' => $format->getId()
            ]);
        }
        
        return $this->render('pokemon_tiene_partner/new.html.twig', [
            'pokemon_tiene_partner' => $poketienepartner,
            'form' => $form->createView(),
            'blocked' => true
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

    /**
     * @Route("/articulos", name="articulos_index", methods={"GET"}) 
     *  
     */
    public function listadoArticulos(PaginatorInterface $paginator, Request $request): Response
    {
        $articulos = $this->getDoctrine()
            ->getRepository(Articulo::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $articulos,
                $request->query->getInt("page", 1),
                6
            );

        return $this->render('shared/listadoarticulos.html.twig', [
            'articulos' => $pagination,
        ]);
    }
    /**
     * @Route("/contacto/{art}", name="contacto")
     *
     * @return void
     */
    public function contacto(\Swift_Mailer $mailer, Request $request, Articulo $art){

       
        $email = $request->get("correo");
        
        $message = (new \Swift_Message('Articulo'))
            ->setFrom('angelesmu1992@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'shared/correo.html.twig',
                    [
                        'articulo' => $art,
                    ]
                ),
                'text/html'
            );
            var_dump($email);          

        $mailer->send($message);   
        
        // creación del pdf
        $html = $this->renderView(
            'shared/correo.html.twig',
            [
                'articulo' => $art,
            ]
        );


        return $this->crea_pdf($html);
    }

    /**
     * Método que genera un pdf pasandole una plantilla html
     * @Route("/pdf", name="pdf")
     * @param [type] $html
     * @return void
     */
    private function crea_pdf($html)
    {
        $filename = sprintf('noticia-%s.pdf', date('Y-m-d_h-i'));
        // Programa encargado de la conversión de html a pdf
        $pdf = new Pdf("\"D:\\wkhtmltopdf\\bin\\wkhtmltopdf.exe\"");
        return new Response(
            $pdf->getOutputFromHtml($html, array(
                'default-header' => null,
                'encoding' => 'utf-8',
                'images' => true,
                'margin-right'  => 7,
                'margin-left'  => 7,
            )),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }

    

}
