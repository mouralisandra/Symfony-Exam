<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry ;
use App\Form\EtudiantFormType ;
use App\Entity\Etudiant ;
use App\Entity\Section ;


#[Route('/Etudiant')]
class BaseController extends AbstractController
{
    // #[Route('/', name: 'app_p_f_e')]
    // public function index(): Response
    // {
    //     return $this->render('Base/index.html.twig', [
    //         'controller_name' => 'BaseController',
    //     ]);
    // }
    #[Route('/', name: 'Etudiant.list')]
    public function index(ManagerRegistry $doctrine): Response {
        $repository = $doctrine->getRepository(Etudiant::class);
        $repositorya = $doctrine->getRepository(Etud::class);
        $Etudiants = $repository->findAll();
        return $this->render('Base/index.html.twig', ['Etudiants' => $Etudiants],['Section' => $Section]);
    }

    #[Route('/add', name: 'Etudiant.add.form')]
    public function addPersonneForm(ManagerRegistry $doctrine,Request $request): Response
    {

        $Etudiant = new Etudiant() ;
        $form = $this->createForm(EtudiantFormType::class,$Etudiant) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager() ;
            $manager->persist($Etudiant) ;
            $manager->flush() ;
            $this->addFlash("info", $Etudiant->getNom()." a ete ajoute avec succes");
            return $this->redirectToRoute('Etudiant.list');

        }else{
            return $this->render('Base/Base-add.html.twig', [
                'form' => $form->createView()
            ]);
        }
        
    }
    public function deleteEtudiant(Personne $personne = null, ManagerRegistry $doctrine): RedirectResponse {
        // RÃ©cupÃ©rer la personne
        if ($Etudiant) {
            // Si la personne existe => le supprimer et retourner un flashMessage de succÃ©s
            $manager = $doctrine->getManager();
            // Ajoute la fonction de suppression dans la transaction
            $manager->remove($Etudiant);
            // ExÃ©cuter la transacition
            $manager->flush();
            $this->addFlash('success', "La personne a été supprimée");
        } else {
            //Sinon  retourner un flashMessage d'erreur
            $this->addFlash('error', "Personne innexistant