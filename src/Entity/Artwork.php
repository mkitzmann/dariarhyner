<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artwork")
 */

class Artwork
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $series;

       /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $position;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $image;

    /**
     * @ORM\Column(type="string")
     */
    private $gridsize;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

      /**
     * @param string $series
     */
    public function setSeries(string $series)
    {
        $this->series = $series;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year)
    {
        $this->year = $year;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }


    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getGridsize(): ?string
    {
        return $this->gridsize;
    }

    public function setGridsize(string $gridsize): self
    {
        $this->gridsize = $gridsize;

        return $this;
    }
}