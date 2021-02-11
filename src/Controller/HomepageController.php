<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\User;
use App\Form\UserType;
use App\Form\SearchUserType;
use App\Form\CreationNewsType;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomepageController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     */
    public function home()
    {
        return $this->render('homepage/index.html.twig', []);
    }

    /**
     * @Route("/admin/createUser", name="user_create")
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $utilisateur = new User();
        $form = $this->createForm(UserType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $utilisateur->setRoles(['ROLE_USER']);
            $nomDossier = $utilisateur->getNumIntervenant();
            if (is_dir($nomDossier)) {
                echo 'Le Salarié existe déja';
            } else {
                mkdir('planning/' . $nomDossier);
            }
            $utilisateur->setPassword(
                $passwordEncoder->encodePassword(
                    $utilisateur,
                    $form->get('password')->getData()
                )
            );
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('utilisateurs');
        }
        $formView = $form->createView();
        return $this->render("user/createUser.html.twig", [
            'formView' => $formView
        ]);
    }

    /**
     * Liste des utilisateurs 
     * 
     * @Route("/admin/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $userRepo, Request $request)
    {
        $users = $userRepo->findAll();
        $form = $this->createForm(SearchUserType::class);
        $search = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $userRepo->search($search->get('mots')->getData());
        }
        return $this->render("user/users.html.twig", [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/utilisateurs/{id}/delete", name="user_delete", methods={"DELETE"})
     */
    public function deleteUser(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('utilisateurs');
    }


    /**
     * @Route("/admin/news/{id}/delete", name="news_delete", methods={"DELETE"})
     */
    public function deleteNews(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }
        return $this->redirectToRoute('news');
    }


    /**
     * @Route("/addNew", name="add_new")
     */
    public function addNew(EntityManagerInterface $em, Request $request)
    {
        $new = new News();
        $new->setDateDeCreation(new DateTime('now'));
        $form = $this->createForm(CreationNewsType::class, $new);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();
            $this->addFlash('notice', 'Super ! Une new à été ajoutée !');
            return $this->redirectToRoute('news');
        }
        return $this->render('news/addNew.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
