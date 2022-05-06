<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ;
use App\Entity\Section ;
use App\Repository\SectionRepository ;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR') ;
        for($i=0; $i<100 ; $i++){
            $Section = new Section() ;

            // $repository = $doctrine->getRepository(Entreprise::class) ;
            // $entreprise = $repository->find($faker->numberBetween(1,99)) ;
            // $Base->setEntreprise($entreprise) ;
            // $Base->setEntreprise($faker->numberBetween(1,99)) ;
            $Section->setDesignation($faker->firstName) ;
        


            $manager->persist($Section);
        }

        $manager->flush();

}}
