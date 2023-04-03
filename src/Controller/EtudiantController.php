<?php

namespace App\Controller;

use App\Form\etudiant;
use App\Service\ServiceEtudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etudiant')]
class EtudiantController extends AbstractController
{

    
    #[Route('/', name: 'app_etudiant')]
    public function index(ServiceEtudiant $service): Response
    {
        $etudiants=$service->getEtudiants();
        
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
            ]);
    }

     #[Route('/show/{id}', name: 'show_etudiant')]
    public function show(ServiceEtudiant $service,int $id): Response
    {
        $etudiant=$service->getEtudiantById($id);
       
        
        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant,
            ]);
    }
    #[Route('/new', name: 'new_etudiant')]
    public function create (ServiceEtudiant $service,Request $request): Response
    {
        $form = $this->createForm(etudiant::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $cin=$form['cin']->getData();
            $age=$form['age']->getData();
            $filiere=$form['filiere']->getData();
            
           $service->addEtudiant($nom,$prenom,$cin,$age,$filiere);
        return $this->redirect($this->generateUrl("app_etudiant"));
        } 
        
         return $this->render('etudiant/new.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/edit/{id}', name: 'edit_etudiant')]
    public function Edit (ServiceEtudiant $service,int $id,Request $request): Response
    {
        $form = $this->createForm(etudiant::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
// dd($form);
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $cin=$form['cin']->getData();
            $age=$form['age']->getData();
            $filiere=$form['filiere']->getData();
            
           $service->updateEtudiant($id,$nom,$prenom,$cin,$age,$filiere);
        return $this->redirect($this->generateUrl("app_etudiant"));
        } 
        
         return $this->render('etudiant/edit.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    
    #[Route('/delete/{id}', name: 'delete_filiere')]
    public function Delete (ServiceEtudiant $service,int $id): Response
    {
        $service->deleteEtudiantById($id);
        return $this->redirect($this->generateUrl("app_etudiant"));
    }
   
        

     
    
}
