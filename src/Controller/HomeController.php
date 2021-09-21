<?php

namespace App\Controller;

use App\Entity\Championnat;
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
    #[Route('/home', name: 'home')]
    public function index(ClubRepository $clubRepo): Response
    {
        $club=$clubRepo-> findAll();
        dump($club);
        return $this->render('home/index.html.twig', [
            'clubs' => $club,


        ]);

    }
    #[Route('/ajouter/club', name: 'ajouter_club')]
    public function addClub(){
        $club=new Club(); $form=$this->createFormBuilder($club)
            ->add("nom",TextType::class)
            ->add("entraineur",TextType::class)
            ->add("points",TextType::class)
            ->add("stade",TextType::class)
            ->add("groupe",TextType::class)
            ->add("sauvegarder",SubmitType::class)->getForm();
            return $this->render('home/ajouterclub.html.twig', [
                'form' => $form->createView(),

            ]);


    }
    #[Route('/ajouter/championnat', name: 'ajouter_championnat')]
    public function addChampionnat(EntityManagerInterface $manager,Request $request){
        $championnat=new Championnat();

        $form=$this->createForm('test')
            ->add ("nom",TextType::class, $championnat)
            ->add("pays",TextType::class, $championnat)
            ->add("sauvegarder",SubmitType::class)->getForm();
            $request->get("nom");
            $request->get("pays");
            dump($request->get("pays"));
        return $this->render('home/ajouterchampionnat.html.twig', [
            'form' => $form->createView(),

        ]);


    }
}
