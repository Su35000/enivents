<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ParticipantController extends AbstractController
{
    #[Route('/participant', name: 'app_participant')]
    public function list(): Response
    {
        return $this->render('participant/edit.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }
}
