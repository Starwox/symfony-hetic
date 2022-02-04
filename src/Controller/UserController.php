<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 03/02/2022
 * Time: 04:35
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/register", name="register")
     */
    public function createUser(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // SETTING GOOD DATAS
            $roles = $user->getRoles();
            $plainpassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainpassword
            );

            $user->setRoles($roles);
            $user->setPassword($hashedPassword);

            $this->em->persist($user);
            $this->em->flush();


            return $this->redirectToRoute('app_login');
        }

        return $this->renderForm('user/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/user/list", name="list_user")
     */
    public function getUsers() {
        $users = $this->em->getRepository(User::class)->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);

    }

    /**
     * @Route("/user/edit/{id}", name="edit_user")
     */
    public function editUser(User $user, UserPasswordHasherInterface $passwordHasher, Request $request)
    {

        $form = $this->createForm(UserType::class, $user, [
            'hidden' => true
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // SETTING GOOD DATAS
            $roles = $user->getRoles();
            $plainpassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainpassword
            );

            $user->setRoles($roles);
            $user->setPassword($hashedPassword);

            $this->em->persist($user);
            $this->em->flush();


            return $this->redirectToRoute('list_user');
        }

        return $this->renderForm('user/new.html.twig', [
            'form' => $form,
        ]);

    }
}