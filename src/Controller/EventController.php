<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function listEvents(EventRepository $er): Response
    {   $listEvents=$er->findAll();
        return $this->render('event/listEvent.html.twig', [
            'controller_name' => 'EventController',
            'listeE' => $listEvents,
        ]);
    }
    #[Route('/new','app_new')]
    public function new(Request $request ,EntityManagerInterface $em){
        $event=new Event();
        $form=$this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('app_event');
        }
        return $this->render('event/new.html.twig',[
            'controller_name'=>'EventController',
            'formE'=>$form->createView()
        ]);
    }

    #[Route('/{id}','event_delete', requirements : ['id'=> '\d+'])]
    public function delete(EntityManagerInterface $em,EventRepository $er,$id){
        $event=$er->find($id);
       
            $em->remove($event);
            $em->flush();
        
        return $this->redirectToRoute('app_event');
    }


    #[Route('/search', name:"searchE")]
    public function search(Request $request, EntityManagerInterface $em)
    {
         $nom= $request->request->get('eventName');
         $q = $em->createQuery('SELECT e FROM App\Entity\Event e WHERE e.nom = :n');
         $q->setParameter('n',$nom);
         $events = $q->getResult();
         return $this->render('event/searchEvent.html.twig', [
             'controller_name' => 'EventController',
             'listeE' => $events,
         ]);

}
}