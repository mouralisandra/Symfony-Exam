<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ;
use App\Entity\Etudiant ;
use App\Entity\Section ;
use App\Repository\EtudiantRepository ;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $faker = Factory::create('fr_FR') ;
        for($i=0; $i<100 ; $i++){
            $Etudiant = new Etudiant() ;

            // $repository = $doctrine->getRepository(Entreprise::class) ;
            // $entreprise = $repository->find($faker->numberBetween(1,99)) ;
            // $Base->setEntreprise($entreprise) ;
            // $Base->setEntreprise($faker->numberBetween(1,99)) ;
            $Etudiant->setNom($faker->firstName) ;
            $Etudiant->setPrenom($faker->firstName) ;
          //  $Etudiant->setSection($Etudiant->getReference('Section' . $i));


            $manager->persist($Etudiant);
        }

        $manager->flush();

    }
} 
