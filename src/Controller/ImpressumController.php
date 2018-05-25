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
        /**
     * @Route("/privacy/en", name="privacy_en")
     */
    public function ViewPrivacyEN()
    {
        return $this->render('home/privacy.en.html.twig', [
            'controller_name' => 'ImpressumController',
                'page' => 'impressum'
        ]);
    }
            /**
     * @Route("/privacy/de", name="privacy_de")
     */
    public function ViewPrivacyDE()
    {
        return $this->render('home/privacy.de.html.twig', [
            'controller_name' => 'ImpressumController',
                'page' => 'impressum'
        ]);
    }
}
