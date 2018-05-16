<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Artwork;

class AdjacentItems
{
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Artwork::class);
    }

    public function adjacentItems(Artwork $item)
    {
        $position = $item->getPosition();
        $count = $this->repository->count([]);

        if($position == 1){
            $prev = $this->repository->findOneBy([
                'position' => $count
            ]);
        }else{
            $prev = $this->repository->findOneBy([
                'position' => ($position - 1)
            ]);
        }

        if($position == $count){
            $next = $this->repository->findOneBy([
                'position' => 1,
            ]);
        }else{
            $next = $this->repository->findOneBy([
                'position' => ($position + 1),
            ]);
        }

        $response = array(
            "next" => $next,
            "prev" => $prev
        );
        return $response;
    }
}