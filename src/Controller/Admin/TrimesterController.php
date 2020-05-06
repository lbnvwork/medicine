<?php

namespace App\Controller\Admin;

use App\Entity\Trimester;
use App\Form\Admin\TrimesterType;
use App\Repository\TrimesterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры сущности "Триместр"
 * @Route("/admin/trimester")
 * @IsGranted("ROLE_ADMIN")
 */
class TrimesterController extends AbstractController
{
    //путь к twig шаблонам
    private const TEMPLATE_PATH = 'admin/trimester/';

    /**
     * @Route("/", name="trimester_index", methods={"GET"})
     */
    public function index(TrimesterRepository $trimesterRepository): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'index.html.twig', [
                'trimesters' => $trimesterRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="trimester_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trimester = new Trimester();
        $form = $this->createForm(TrimesterType::class, $trimester);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trimester);
            $entityManager->flush();

            return $this->redirectToRoute('trimester_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'new.html.twig', [
                'trimester' => $trimester,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="trimester_show", methods={"GET"})
     */
    public function show(Trimester $trimester): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'show.html.twig', [
                'trimester' => $trimester,
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="trimester_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trimester $trimester): Response
    {
        $form = $this->createForm(TrimesterType::class, $trimester);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trimester_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'edit.html.twig', [
                'trimester' => $trimester,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="trimester_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trimester $trimester): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trimester->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trimester);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trimester_index');
    }
}
