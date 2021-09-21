<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Championnat;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $championnat = new Championnat();
         $championnat->setNom("Ligue 1");
         $championnat->setPays("France");
         $manager->persist($championnat);
         $manager->flush();

    }

}
