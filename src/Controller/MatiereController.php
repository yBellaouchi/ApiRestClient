<?php

namespace App\Controller;

use App\Form\matiere;
use App\Service\ServiceMatiere;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/matiere')]
class MatiereController extends AbstractController
{

    
    #[Route('/', name: 'app_matiere')]
    public function index(ServiceMatiere $service): Response
    {
        $matieres=$service->getMatieres();
        
        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
            ]);
    }

     #[Route('/show/{id}', name: 'show_matiere')]
    public function show(ServiceMatiere $service,int $id): Response
    {
        $matiere=$service->getMatiereById($id);
       
        
        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
            ]);
    }
    #[Route('/new', name: 'new_matiere')]
    public function create (ServiceMatiere $service,Request $request): Response
    {
        $form = $this->createForm(matiere::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $libelle=$form['libelle']->getData();
            $filiere=$form['filiere']->getData();
            
           $service->addMatiere($libelle,$filiere);
        return $this->redirect($this->generateUrl("app_matiere"));
        } 
        
         return $this->render('matiere/new.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/edit/{id}', name: 'edit_matiere')]
    public function Edit (ServiceMatiere $service,int $id,Request $request): Response
    {
        $form = $this->createForm(matiere::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $libelle=$form['libelle']->getData();
            $filiere=$form['filiere']->getData();
            
           $service->updateMatiere($id,$libelle,$filiere);
        return $this->redirect($this->generateUrl("app_matiere"));
        } 
        
         return $this->render('matiere/edit.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/delete/{id}', name: 'delete_filiere')]
    public function Delete (ServiceMatiere $service,int $id,Request $request): Response
    {
        $service->deleteMatiereById($id);
        return $this->redirect($this->generateUrl("app_matiere"));
    }
   
        

     
    
}
