<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/affiche', name: 'affiche')]
    public function index(ManagerRegistry $doctrine ): Response
    {
        $repo = $doctrine->getRepository(Etudiant::class);
        $Etudiants = $repo->findAll();
        return $this->render('base/index.html.twig', [
            'Etudiants' => $Etudiants
        ]);
    }
    #[Route('/ajout/{id?0}', name: 'ajout')]
    public function ajout(ManagerRegistry $doctrine , Request $request , $id): Response
    {
        if ($id ) {
            $repo = $doctrine->getRepository(Etudiant::class);
            $Etudiant = $repo->findOneBy(['id'=>$id],[]);
              }
        else {
            $Etudiant = new Etudiant();

        }
        $form = $this->createForm(EtudiantType::class,$Etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager=$doctrine->getManager();
            $manager->persist($Etudiant);
            $manager->flush();
            return $this->redirectToRoute("affiche");
        }
        else {
            return $this->render('base/base-add.html.twig', [
                'form' => $form->createView() ]);
        }
    }

    #[Route('/delete/{id?0}', name: 'delete')]
    public function delete(Etudiant $Etudiant = null,ManagerRegistry $doctrine): Response
    {
        {          if (!$Etudiant) {
            $this->addFlash("error","L'étudiant n'existe pas'");
        }
        else {
            $manager=$doctrine->getManager();
            $manager->remove($Etudiant);
            $manager->flush();
            $this->addFlash("success","L'étudiant a été supprimé avec succès");
            }
            return $this->redirectToRoute("affiche");
    }
}
}

