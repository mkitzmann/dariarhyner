<?php

namespace App\Controller;

use App\Entity\Artwork;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{

    public function indexAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Artwork::class);
        $artworks = $repo->findBy([], ['position' => 'ASC']);

        return $this->render('home/index.html.twig',array(
            'artworks' => $artworks));
    }

    public function AboutAction()
    {
        return $this->render('home/about.html.twig');
    }

}
