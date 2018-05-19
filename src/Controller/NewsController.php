<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Cocur\Slugify\Slugify;

/**
 * @Route("/")
 */
class NewsController extends Controller
{
    /**
     * @Route("/news", name="news_index", methods="GET")
     */
    public function index(NewsRepository $newsRepository): Response
    {
        $repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->findBy([], ['date' => 'DESC']);
        return $this->render('home/news.html.twig', [
            'news' => $news,
            'page' => 'news'
            ]);
    }

    /**
     * @Route("admin/news", name="news_admin", methods="GET|POST")
     */
    public function NewsAdmin(Request $request, FileUploader $fileUploader)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(News::class);

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $news->getImage();
            dump($file);
            $directory = $this->getParameter('artwork_directory');
            $fileName = $fileUploader->upload($file, $directory);
            $news->setImage($fileName);

            $title = $news->getTitle();
            $slugify = new Slugify();
            $news->setSlug($slugify->slugify($title));

            
            
            $em->persist($news);
            $em->flush();

            return $this->redirect('/admin/news');
        }

        $repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->findBy([], ['date' => 'DESC']);
        
        return $this->render('admin/news/index.html.twig', [
            'controller_name' => 'AdminController',
            'items' => $news,
            'form' => $form->createView(),
            'page' => 'news'
        ]);
    }

    /**
     * @Route("admin/news/new", name="news_new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(News::class);

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $news->getImage();
            $directory = $this->getParameter('artwork_directory');
            $fileName = $fileUploader->upload($file, $directory);
            $news->setImage($fileName);

            $title = $news->getTitle();
            $slugify = new Slugify();
            $news->setSlug($slugify->slugify($title));

            
            
            $em->persist($news);
            $em->flush();

            return $this->redirect('/admin/news');
        }


        return $this->render('admin/news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
            'page' => 'news'
        ]);
    }

    /**
     * @Route("admin/news/{id}", name="news_show", methods="GET")
     */
    public function show(News $news): Response
    {
        return $this->render('admin/news/show.html.twig', ['news' => $news]);
    }

    /**
     * @Route("admin/news/{id}/edit", name="news_edit", methods="GET|POST")
     */
    public function edit(Request $request, News $news): Response
    {
        $newsImage = $news->getImage();

        $news->setImage( 
            new File($this->getParameter('artwork_directory').'/'.$newsImage
        ));

        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($news->getImage()==NULL){
                $news->setImage($newsImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_admin', ['id' => $news->getId()]);
        }

        return $this->render('admin/news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
            'page' => 'news',
            'artworkimage' => $newsImage,
        ]);
    }

    /**
     * @Route("admin/news/{id}", name="news_delete", methods="DELETE")
     */
    public function delete(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();
        }

        return $this->redirectToRoute('news_admin');
    }
}
