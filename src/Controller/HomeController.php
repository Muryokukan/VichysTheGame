<?php

namespace App\Controller;

use App\Entity\Strategies\Collaborator;
use App\Entity\Strategies\Nazi;
use App\Entity\Strategies\Resistant;
use App\Entity\Strategies\Undecided;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TournamentService;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [

        ]);
    }
}