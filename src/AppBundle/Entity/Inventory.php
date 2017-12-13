<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventory
 *
 * @ORM\Table(name="inventory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InventoryRepository")
 */
class Inventory
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
     * @ORM\OneToMany(targetEntity="Stuff", mappedBy="stuffs")
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
     * Constructor
     */
    public function __construct()
    {
        $this->stuffs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stuff
     *
     * @param \AppBundle\Entity\Stuff $stuff
     *
     * @return Inventory
     */
    public function addStuff(\AppBundle\Entity\Stuff $stuff)
    {
        $this->stuffs[] = $stuff;

        return $this;
    }

    /**
     * Remove stuff
     *
     * @param \AppBundle\Entity\Stuff $stuff
     */
    public function removeStuff(\AppBundle\Entity\Stuff $stuff)
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
