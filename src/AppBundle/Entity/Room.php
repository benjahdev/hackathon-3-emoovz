<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="StuffBasket", mappedBy="rooms")
     */
    private $stuffs;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stuffs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stuff
     *
     * @param \AppBundle\Entity\StuffBasket $stuff
     *
     * @return Room
     */
    public function addStuff(\AppBundle\Entity\StuffBasket $stuff)
    {
        $this->stuffs[] = $stuff;

        return $this;
    }

    /**
     * Remove stuff
     *
     * @param \AppBundle\Entity\StuffBasket $stuff
     */
    public function removeStuff(\AppBundle\Entity\StuffBasket $stuff)
    {
        $this->stuffs->removeElement($stuff);
    }

    /**
     * Get stuffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffs()
    {
        return $this->stuffs;
    }
}
