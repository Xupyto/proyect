<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Usuario;
use App\Form\EquipoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/equipo")
 */
class EquipoController extends AbstractController
{
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
     * @Route("/{idequipo}", name="equipo_show", methods={"GET"})
     */
    public function show(Equipo $equipo): Response
    {
        return $this->render('build/show.html.twig', [
            'equipo' => $equipo,
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
}
