<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImpressumController extends Controller
{
    /**
     * @Route("/impressum", name="impressum")
     */
    public function index()
    {
        return $this->render('home/impressum.html.twig', [
            'controller_name' => 'ImpressumController',
                'page' => 'impressum'
        ]);
    }
}
