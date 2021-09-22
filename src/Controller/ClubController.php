<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Entity\Club;
use App\Repository\ChampionnatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ClubFormType;

class ClubController extends AbstractController
{
    /**
     * @Route("/ajouter/club", name="ajouterclub")
     */
    public function ajouterClub(EntityManagerInterface $manager, Request $request, ChampionnatRepository $championnatRepo): Response
    {
        $club = new Club();
        $routeName = $request->attributes->get('_route');
        $championnat = $championnatRepo->findAll();
        $form = $this->createForm(ClubFormType::class, $club);
        $form->handleRequest($request);
        $idChampionnat = $request->get("championnat");
        if ($form->isSubmitted() && $form->isValid()) {
            $clubChampionnat = $championnatRepo->findOneBy(['id' => $idChampionnat]);
            $club->setChampionnat($clubChampionnat);
            $manager->persist($club);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('club/index.html.twig', [
            'form' => $form->createView(),
            'championnats' => $championnat,
            'routeName' => $routeName

        ]);
    }

    /**
     * @Route("/editer/club/{id}", name="editerclub")
     */
    public function editClub(EntityManagerInterface $manager, Request $request, ChampionnatRepository $championnatRepo, Club $club): Response
    {
        $championnatAll = $championnatRepo->findAll();
        $routeName = $request->attributes->get('_route');
        $form = $this->createForm(ClubFormType::class, $club);
        $form->handleRequest($request);
        $idChampionnat = $request->get("championnat");
        if ($form->isSubmitted() && $form->isValid()) {
            $clubChampionnat = $championnatRepo->findOneBy(['id' => $idChampionnat]);
            $club->setChampionnat($clubChampionnat);
            $manager->persist($club);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('club/index.html.twig', [
            'form' => $form->createView(),
            'championnats' => $championnatAll,
            'routeName' => $routeName
        ]);
    }
    /**
     * @Route("/supprimer/club/{id}", name="supprimerclub")
     */
    public function supprimerChampionnat(EntityManagerInterface $manager,Request $request, Club $club)
    {

        $manager->remove($club);
        $manager->flush();
        return $this->redirectToRoute('home');

    }
}