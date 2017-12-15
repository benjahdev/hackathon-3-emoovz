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
     * @ORM\ManyToMany(targetEntity="Stuff", mappedBy="rooms")
     */
    private $stuffs;

    /**
     * @var boolean
     * @ORM\Column(name="selected", type="boolean", nullable=true)
     */
    private $selected = false;


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
     * @param \AppBundle\Entity\Stuff $stuff
     *
     * @return Room
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

    /**
     * Set selected
     *
     * @param boolean $selected
     *
     * @return Room
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return boolean
     */
    public function getSelected()
    {
        return $this->selected;
    }
}
