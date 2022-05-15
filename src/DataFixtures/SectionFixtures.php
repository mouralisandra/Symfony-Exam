<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();
        for ($i=0; $i < 50; $i++) { 
            $section = new Section();
            $section->setDesignation($faker->word);
            for ($j=0; $j < rand(1, 20); $j++) { 
                $etudiant = new Etudiant();
                $etudiant->setNom($faker->lastName);
                $etudiant->setPrenom($faker->firstName);
                $section->addEtudiant($etudiant);
                $etudiant->setSection($section);
                $manager->persist($etudiant);
            }
            $manager->persist($section);
        }

        for ($i=0; $i < 50; $i++) { 
            $etudiant = new Etudiant();
            $etudiant->setNom($faker->lastName);
            $etudiant->setPrenom($faker->firstName);
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}