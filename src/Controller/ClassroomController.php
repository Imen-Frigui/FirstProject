<?php

namespace App\Controller;


use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;

//use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/affichec', name: 'app_affichec')]
    public function affichec(): Response
    {
        $classrooms = $this->getDoctrine()
            ->getRepository(Classroom::class)->findAll();
        return $this->render('Classroom/affichec.html.twig', [
            'c' => $classrooms,
        ]);
    }

    #[Route('/affichec/{id}', name: 'delete')]
    public function delete($id, ClassroomRepository $r, ManagerRegistry $doctrine): Response
    {
        $classroom = $r->find($id);
        $em = $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('app_affichec');
    }
}