<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/articulo")
 */
class ArticuloController extends AbstractController
{
    /**
     * @Route("/", name="articulo_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $articulos = $this->getDoctrine()
            ->getRepository(Articulo::class)
            ->findAll();

            $pagination = $paginator->paginate(
                $articulos,
                $request->query->getInt("page", 1),
                10
            );

        return $this->render('articulo/index.html.twig', [
            'articulos' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="articulo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articulo = new Articulo();
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $foto = $form['Fileimg']->getData();
            if ($foto) {
                $nombrearchivo = $foto->getClientOriginalName();
                $foto->move(
                    $this->getParameter('imagenes_noticias'),
                    $nombrearchivo
                );
                $articulo->setFoto($nombrearchivo);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articulo);
            $entityManager->flush();

            return $this->redirectToRoute('articulo_index');
        }

        return $this->render('articulo/new.html.twig', [
            'articulo' => $articulo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idarticulo}", name="articulo_show", methods={"GET"})
     */
    public function show(Articulo $articulo): Response
    {
        return $this->render('articulo/show.html.twig', [
            'articulo' => $articulo,
        ]);
    }

    /**
     * @Route("/{idarticulo}/edit", name="articulo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articulo $articulo): Response
    {
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foto = $form['Fileimg']->getData();
            if ($foto) {
                $nombrearchivo = $foto->getClientOriginalName();
                $foto->move(
                    $this->getParameter('imagenes_noticias'),
                    $nombrearchivo
                );
                $articulo->setFoto($nombrearchivo);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articulo_index');
        }

        return $this->render('articulo/edit.html.twig', [
            'articulo' => $articulo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idarticulo}", name="articulo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Articulo $articulo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articulo->getIdarticulo(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articulo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articulo_index');
    }
}
