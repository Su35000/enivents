<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use App\Repository\LieuRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lieu', name: 'lieu_')]
class LieuController extends AbstractController
{
    #[Route('/new', name: 'new')]
    public function new(Request $request, LieuRepository $lieuRepository): Response
    {

        $lieu = new Lieu();

        $lieuForm = $this->createForm(LieuType::class, $lieu);
        $lieuForm->handleRequest(($request));

        if ($lieuForm->isSubmitted() && $lieuForm->isValid()) {

            $lieuRepository->add($lieu, true);

            $this->addFlash('success', "L'évènement à bien été crée");
            $this->addFlash('success', "Le lieu a bien été ajouté.");
            return $this->redirectToRoute('sortie_new', [
                'lieu' => $lieu
            ]);
        }


        return $this->render('lieu/new.html.twig', [
            'controller_name' => 'LieuController',
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(int $id, Request $request, LieuRepository $lieuRepository): Response
    {

        $lieu = $lieuRepository->find($id);

        if (!$lieu) {
            throw $this->createNotFoundException("O0Oo0PS ! Le lieu n'existe pas !");
        }

        $lieuForm = $this->createForm(LieuType::class, $lieu);

        $lieuForm->handleRequest(($request));

        if ($lieuForm->isSubmitted() && $lieuForm->isValid()) {

            $lieuRepository->add($lieu, true);

            $this->addFlash('success', "Le lieu a bien été modifié.");

            return $this->redirectToRoute('sortie_new', [
                'lieu' => $lieu
            ]);
        }


        return $this->render('lieu/new.html.twig', [
            'controller_name' => 'LieuController',
        ]);
    }


    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, LieuRepository $lieuRepository): Response
    {

        $lieu = $lieuRepository->find($id);

        //erreur 404
        if (!$lieu) {
            throw $this->createNotFoundException("O0Oo0PS ! Le lieu n'existe pas !");
        }

        return $this->render('lieu/details.html.twig');

    }


}
