<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FrontController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
        return $this->render('front/profil.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }


/* *************************************** INSCRIPTION *****************************************************************/
#[Route('/inscription', name: 'app_inscription', methods: ['GET', 'POST'])]
public function inscription(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $entityManager): Response
{
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $user->setDateCreation( new \DateTime());
    $user->setRoles( ["ROLE_USER"]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $password = $encoder->hashPassword($user, $user->getPassword() );
        $user->setPassword($password);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

    
    return $this->renderForm('front/inscription.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);
}

}
