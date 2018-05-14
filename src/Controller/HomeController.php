<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('home/index.html.twig');
    }

    public function AboutAction()
    {
        return $this->render('home/about.html.twig');
    }

}
