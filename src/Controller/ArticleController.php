<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @param \App\Repository\ArticleRepository $repo
     *
     * @Route("/article/{id}", requirements={"id"="\d+"})
     */
    public function detail(ArticleRepository $repo, int $id)
    {
        $article = $repo->find($id);

        if (!$article) {
            throw $this->createNotFoundException();
        }

        return $this->render('article/detail.html.twig', [
            'article' => $article,
        ]);
    }
}
