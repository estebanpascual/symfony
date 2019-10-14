<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ArticlesType;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->FindAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController', 'articles' => $articles
        ]);
    }

     /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig', [ 'titre' => "Voici le titre", 'age' => 11 ]);
    }

     /**
     * @Route("/ajout", name="ajout")
     */
    public function ajout(Request $request, ObjectManager $manager) {
       
        $Articles = new Article();
        $form = $this->createForm(ArticlesType::class, $Articles );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        { 
            $manager->persist($Articles);
            $manager->flush();

            return $this->redirectToRoute('blog');
        }  

        return $this->render('blog/ajout.html.twig', [ 'form' => $form->createView()]);
    }

    /**
     * @Route("/galerie", name="galerie")
     */
    public function  galerie() {
        return $this->render('blog/galerie.html.twig');
    }

}
