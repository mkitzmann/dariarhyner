<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArtworkType;
use App\Entity\Artwork;
use App\Service\FileUploader;
use Cocur\Slugify\Slugify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

class AdminController extends Controller
{
    public function AdminIndex(Request $request, FileUploader $fileUploader)
    {
        $artwork = new Artwork();
        $form = $this->createForm(ArtworkType::class, $artwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(Artwork::class);
            $count = $repo->count([]);
            $artwork->setPosition($count+1);

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $artwork->getImage();
            $directory = $this->getParameter('artwork_directory');
            $fileName = $fileUploader->upload($file, $directory);
            $artwork->setImage($fileName);

            $title = $artwork->getTitle();
            $slugify = new Slugify();
            $artwork->setSlug($slugify->slugify($title));

            
            
            $em->persist($artwork);
            $em->flush();

            return $this->redirect('/admin');
        }

        $repo = $this->getDoctrine()->getRepository(Artwork::class);
        $artworks = $repo->findBy([], ['position' => 'ASC']);
        
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'items' => $artworks,
            'form' => $form->createView(),
            'page' => 'artwork',
        ]);
    }

        /**
     * @ParamConverter("artwork", class="App\Entity\Artwork", options={"mapping": {"artwork_slug": "slug"}})
     */
    public function ArtworkPosition($position, Artwork $artwork)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $swapArtwork = $entityManager
        ->getRepository(Artwork::class)
        ->findOneBy([
         'position' => $position
        ]);

    $swapArtwork->setPosition($artwork->getPosition());

    $artwork->setPosition($position);
    $entityManager->flush();
    
    return $this->redirect($this->generateUrl('AdminRoute'));
    }

     /**
     * @ParamConverter("artwork", class="App\Entity\Artwork", options={"mapping": {"artwork_slug": "slug"}})
     */
    public function ArtworkDelete(Artwork $artwork)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($artwork);

        $entityManager->flush();

        $repo = $entityManager->getRepository(Artwork::class);
        $artworks = $repo->findBy([], ['position' => 'ASC']);        

        $i=1;
        foreach($artworks as $item){
            $item->setPosition($i);
            $i++;
        }

        $entityManager->flush();

        return $this->redirectToRoute('AdminRoute');
    }

        /**
     * @ParamConverter("artwork", class="App\Entity\Artwork", options={"mapping": {"artwork_slug": "slug"}})
     */
    public function EditArtwork(Request $request, Artwork $artwork): Response
    {
        $artworkImage = $artwork->getImage();

        $artwork->setImage( 
            new File($this->getParameter('artwork_directory').'/'.$artworkImage
        ));

        $form = $this->createForm(ArtworkType::class, $artwork);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            if($artwork->getImage()==NULL){
                $artwork->setImage($artworkImage);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('AdminRoute');
        }

        return $this->render('admin/artwork/edit.html.twig', [
            'artwork' => $artwork,
            'form' => $form->createView(),
            'artworkimage' => $artworkImage,
            'page' => 'artwork',
        ]);
    }
}
