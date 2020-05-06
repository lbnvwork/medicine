<?php

namespace App\Controller;

use App\Entity\AuthUser;
use App\Form\Admin\AuthUser\AuthUserRoleType;
use App\Form\Admin\AuthUser\AuthUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/auth_user")
 */
class AuthUserController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    /**
     * @Route("/", name="auth_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render(
            'admin/auth_user/index.html.twig', [
                'auth_users' => $userRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="auth_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $authUser = new AuthUser();
        /** @var Form $form */
        $form = $this->createFormBuilder()
            ->add('authUser', AuthUserType::class)
            ->add('onlyRole', AuthUserRoleType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->getRepository(AuthUser::class)->addUserFromAdmin($form, $authUser);
            $entityManager->flush();

            return $this->redirectToRoute('auth_user_index');
        }

        return $this->render(
            'admin/auth_user/new.html.twig', [
                'auth_user' => $authUser,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="auth_user_show", methods={"GET"})
     */
    public function show(AuthUser $authUser): Response
    {
        return $this->render(
            'admin/auth_user/show.html.twig', [
                'auth_user' => $authUser,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="auth_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AuthUser $authUser): Response
    {
        /** @var Form $form */
        $form = $this->createFormBuilder()
            ->setData(
                [
                    'authUser' => $authUser
                ]
            )
            ->add('authUser', AuthUserType::class)
            ->add('onlyRole', AuthUserRoleType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->getRepository(AuthUser::class)->addUserFromAdmin($form, $authUser);
            $entityManager->flush();

            return $this->redirectToRoute('auth_user_index');
        }

        return $this->render(
            'admin/auth_user/edit.html.twig', [
                'auth_user' => $authUser,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="auth_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AuthUser $authUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$authUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($authUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('auth_user_index');
    }
}
