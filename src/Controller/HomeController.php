<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Form\ChampionnatFormType;
use App\Repository\ChampionnatRepository;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Club;
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ClubRepository $clubRepo): Response
    {
        $club = $clubRepo->findAll();
        dump($club);
        return $this->render('home/index.html.twig', [
            'clubs' => $club,


        ]);

    }

    /**
     * @Route("/ajouter/championnat", name="ajouterchampionnat")
     */
    public function addChampionnat(EntityManagerInterface $manager, Request $request)
    {
        $championnat = new Championnat();

        $form = $this->createForm(ChampionnatFormType::class, $championnat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($championnat);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('home/ajouterchampionnat.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/editer/championnat/{id}", name="editerchampionnat")
     */
    public function editChampionnat(EntityManagerInterface $manager, Request $request, Championnat $championnat)
    {


        $form = $this->createForm(ChampionnatFormType::class, $championnat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($championnat);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('home/ajouterchampionnat.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/supprimer/championnat/{id}", name="supprimerchampionnat")
     */
    public function supprimerChampionnat(EntityManagerInterface $manager, Request $request, Championnat $championnat)
    {

        $manager->remove($championnat);
        $manager->flush();
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/club/{id}", name="detailclub")
     */
    public function showClub(ClubRepository $clubRepo, $id,ChampionnatRepository $championnatRepo)
    {
        $club = $clubRepo->findOneBy(['id' => $id]);
        $idChampionnat = $club->getChampionnat();
        $championnnat = $championnatRepo->findOneBy(['id' => $idChampionnat]);
        dump($club);

        return $this->render('club/detailClub.html.twig', [
            'club'=>$club

        ]);
    }
}