<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Stuff", mappedBy="category")
     */
    private $stuffs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stuffs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return Category
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
     * Add stuff
     *
     * @param \AppBundle\Entity\Stuff $stuff
     *
     * @return Category
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
