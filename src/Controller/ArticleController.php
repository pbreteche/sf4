<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @param \App\Entity\Article $article
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/article/{id}", requirements={"id"="\d+"})
     */
    public function detail(Article $article)
    {
        return $this->render('article/detail.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/new")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article, [
            'method' => 'POST',
            'validation_groups' => "publication"
        ])
            ->add('title')
            ->add('content')
            ->getForm();
        $form->add('publish', SubmitType::class, [
            'label' => 'Publier'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setPublishedAt(new \DateTime());
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'Bravo, ça a bien marché!');
            return $this->redirectToRoute('app_article_detail', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('article/create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }
}
