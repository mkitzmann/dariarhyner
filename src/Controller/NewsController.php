<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class NewsController extends Controller
{
    public function ViewNews()
    {
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->render('home/news.html.twig', [
            'news' => $news,
        ]);
    }
        /**
     * @ParamConverter("news", class="App\Entity\News", options={"mapping": {"news_slug": "slug"}})
     */
    public function ViewSingleNews(News $news)
    {
        return $this->render('home/singleNews.html.twig', [
            'news' => $news,
        ]);
    }
}
