<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use App\Service\AdjacentItems;
use App\Entity\Artwork;
use Cocur\Slugify\Slugify;

class ArtworkController extends Controller
{
    /**
     * @ParamConverter("artwork", class="App\Entity\Artwork", options={"mapping": {"artwork_slug": "slug"}})
     */
    public function ViewArtwork(Artwork $artwork, AdjacentItems $adjacentItems)
    {
        $adjacentLinks = $adjacentItems->adjacentItems($artwork);
      
        return $this->render('home/single.html.twig',array(
            'artwork' => $artwork,
            'nextlink' => $adjacentLinks['next'],
            'prevlink' => $adjacentLinks['prev']
        ));
    }
    
}