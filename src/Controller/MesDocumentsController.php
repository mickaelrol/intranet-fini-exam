<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesDocumentsController extends AbstractController
{
    /**
     * @Route("/mesdocuments", name="mes_documents")
     */
    public function index(): Response
    {
        return $this->render('mes_documents/index.html.twig', []);
    }
}
