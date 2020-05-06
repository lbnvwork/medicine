<?php

namespace App\Controller\Admin;

use App\Entity\Polimorphism;
use App\Form\Admin\PolimorphismType;
use App\Repository\PolimorphismRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/polimorphism")
 */
class PolimorphismController extends AbstractController
{
    /**
     * @Route("/", name="polimorphism_index", methods={"GET"})
     */
    public function index(PolimorphismRepository $polimorphismRepository): Response
    {
        return $this->render(
            'admin/polimorphism/index.html.twig', [
                'polimorphisms' => $polimorphismRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="polimorphism_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $polimorphism = new Polimorphism();
        $form = $this->createForm(PolimorphismType::class, $polimorphism);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($polimorphism);
            $entityManager->flush();

            return $this->redirectToRoute('polimorphism_index');
        }

        return $this->render(
            'admin/polimorphism/new.html.twig', [
                'polimorphism' => $polimorphism,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="polimorphism_show", methods={"GET"})
     */
    public function show(Polimorphism $polimorphism): Response
    {
        return $this->render(
            'admin/polimorphism/show.html.twig', [
                'polimorphism' => $polimorphism,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="polimorphism_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Polimorphism $polimorphism): Response
    {
        $form = $this->createForm(PolimorphismType::class, $polimorphism);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polimorphism_index');
        }

        return $this->render(
            'admin/polimorphism/edit.html.twig', [
                'polimorphism' => $polimorphism,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="polimorphism_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Polimorphism $polimorphism): Response
    {
        if ($this->isCsrfTokenValid('delete'.$polimorphism->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($polimorphism);
            $entityManager->flush();
        }

        return $this->redirectToRoute('polimorphism_index');
    }
}
