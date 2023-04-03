<?php

namespace App\Controller;

use App\Form\filiere;
use App\Service\ServiceFiliere;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filiere')]
class FiliereController extends AbstractController
{

    
    #[Route('/', name: 'app_filiere')]
    public function index(ServiceFiliere $service): Response
    {
        $filieres=$service->getFilieres();
        
        return $this->render('filiere/index.html.twig', [
            'filieres' => $filieres,
            ]);
    }

     #[Route('/show/{id}', name: 'show_filiere')]
    public function show(ServiceFiliere $service,int $id): Response
    {
        $filiere=$service->getFiliereById($id);
       
        
        return $this->render('filiere/show.html.twig', [
            'filiere' => $filiere,
            ]);
    }
    #[Route('/new', name: 'new_filiere')]
    public function create (ServiceFiliere $service,Request $request): Response
    {
        $form = $this->createForm(filiere::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $libelle=$form['libelle']->getData();
            
           $service->addFiliere($libelle);
        return $this->redirect($this->generateUrl("app_filiere"));
        } 
        
         return $this->render('filiere/new.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/edit/{id}', name: 'edit_filiere')]
    public function Edit (ServiceFiliere $service,int $id,Request $request): Response
    {
        $form = $this->createForm(filiere::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $libelle=$form['libelle']->getData();
            
           $service->updateFiliere($id,$libelle);
        return $this->redirect($this->generateUrl("app_filiere"));
        } 
        
         return $this->render('filiere/edit.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/delete/{id}', name: 'delete_filiere')]
    public function delete (ServiceFiliere $service,int $id,Request $request): Response
    {
        $service->deleteFiliereById($id);
        return $this->redirect($this->generateUrl("app_filiere"));
    }
   
        

     
    
}
