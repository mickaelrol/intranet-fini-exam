<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function news(NewsRepository $newsRepo, Request $request)
    {
        $limit = 3;
        $page = (int)$request->query->get("page", 1);

        $news = $newsRepo->getPaginatedNews($page, $limit);

        $total = $newsRepo->getTotalNews();



        return $this->render('news/index.html.twig', [
            'news' => $news,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }
}
