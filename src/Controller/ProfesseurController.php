<?php

namespace App\Controller;

use App\Form\professeur;
use App\Service\ServiceProfesseur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/professeur')]
class ProfesseurController extends AbstractController
{

    
    #[Route('/', name: 'app_professeur')]
    public function index(ServiceProfesseur $service): Response
    {
        $professeurs=$service->getProfesseurs();
        
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $professeurs,
            ]);
    }

     #[Route('/show/{id}', name: 'show_professeur')]
    public function show(ServiceProfesseur $service,int $id): Response
    {
        $professeur=$service->getProfesseurById($id);
        // dd($professeur);
       
        
        return $this->render('professeur/show.html.twig', [
            'professeur' => $professeur,
            ]);
    }
    #[Route('/new', name: 'new_professeur')]
    public function create (ServiceProfesseur $service,Request $request): Response
    {
        $form = $this->createForm(professeur::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $cin=$form['cin']->getData();
            $filiere=$form['matiere']->getData();
            
           $service->addProfesseur($nom,$prenom,$cin,$filiere);
        return $this->redirect($this->generateUrl("app_professeur"));
        } 
        
         return $this->render('professeur/new.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/edit/{id}', name: 'edit_professeur')]
    public function Edit (ServiceProfesseur $service,int $id,Request $request): Response
    {
        $form = $this->createForm(professeur::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
// dd($form);
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $cin=$form['cin']->getData();
           $matiere=$form['matiere']->getData();
            
           $service->updateProfesseur($id,$nom,$prenom,$cin,$matiere);
        return $this->redirect($this->generateUrl("app_professeur"));
        } 
        
         return $this->render('professeur/edit.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    
    #[Route('/delete/{id}', name: 'delete_professeur')]
    public function Delete (ServiceProfesseur $service,int $id): Response
    {
        $service->deleteProfesseurById($id);
        return $this->redirect($this->generateUrl("app_professeur"));
    }
   
        

     
    
}
