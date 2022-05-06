<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ;
use App\Entity\Base ;
use App\Entity\Entreprise ;
use App\Repository\EntrepriseRepository ;

class BaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR') ;
        for($i=0; $i<100 ; $i++){
            $Base = new Base() ;

            // $repository = $doctrine->getRepository(Entreprise::class) ;
            // $entreprise = $repository->find($faker->numberBetween(1,99)) ;
            // $Base->setEntreprise($entreprise) ;
            // $Base->setEntreprise($faker->numberBetween(1,99)) ;
            $Base->setNom($faker->firstName) ;
            //$pfe->setEntreprise($this->getReference('entreprise' . $i));


            $manager->persist($Base);
        }

        $manager->flush();
    }
}
