<?php

namespace App\Controller;

use App\Repository\ChampionnatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChampionnatController extends AbstractController
{
    /**
     * @Route("/championnat", name="championnat")
     */
    public function index(ChampionnatRepository $championnatRepo): Response
    {
        $championnat = $championnatRepo->findAll();

        return $this->render('championnat/index.html.twig', [
            'championnats' => $championnat,
        ]);
    }
}
