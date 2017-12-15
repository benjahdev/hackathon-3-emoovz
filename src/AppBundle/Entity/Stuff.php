<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table(name="stuff")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StuffRepository")
 */
class Stuff
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
     * @var int
     *
     * @ORM\Column(name="dimension_height", type="integer", nullable=true)
     */
    private $dimensionHeight;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_width", type="integer", nullable=true)
     */
    private $dimensionWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_deep", type="integer", nullable=true)
     */
    private $dimensionDeep;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_weight", type="boolean")
     */
    private $isWeight;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_fragile", type="boolean")
     */
    private $isFragile;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_custom", type="boolean")
     */
    private $isCustom;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="stuffs")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="stuffs")
     */
    private $rooms;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory", inversedBy="stuffs")
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
     * @return Stuff
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
     * Set dimensionHeight
     *
     * @param integer $dimensionHeight
     *
     * @return Stuff
     */
    public function setDimensionHeight($dimensionHeight)
    {
        $this->dimensionHeight = $dimensionHeight;

        return $this;
    }

    /**
     * Get dimensionHeight
     *
     * @return int
     */
    public function getDimensionHeight()
    {
        return $this->dimensionHeight;
    }

    /**
     * Set dimensionWidth
     *
     * @param integer $dimensionWidth
     *
     * @return Stuff
     */
    public function setDimensionWidth($dimensionWidth)
    {
        $this->dimensionWidth = $dimensionWidth;

        return $this;
    }

    /**
     * Get dimensionWidth
     *
     * @return int
     */
    public function getDimensionWidth()
    {
        return $this->dimensionWidth;
    }

    /**
     * Set dimensionDeep
     *
     * @param integer $dimensionDeep
     *
     * @return Stuff
     */
    public function setDimensionDeep($dimensionDeep)
    {
        $this->dimensionDeep = $dimensionDeep;

        return $this;
    }

    /**
     * Get dimensionDeep
     *
     * @return int
     */
    public function getDimensionDeep()
    {
        return $this->dimensionDeep;
    }

    /**
     * Set isWeight
     *
     * @param boolean $isWeight
     *
     * @return Stuff
     */
    public function setIsWeight($isWeight)
    {
        $this->isWeight = $isWeight;

        return $this;
    }

    /**
     * Get isWeight
     *
     * @return bool
     */
    public function getIsWeight()
    {
        return $this->isWeight;
    }

    /**
     * Set isFragile
     *
     * @param boolean $isFragile
     *
     * @return Stuff
     */
    public function setIsFragile($isFragile)
    {
        $this->isFragile = $isFragile;

        return $this;
    }

    /**
     * Get isFragile
     *
     * @return bool
     */
    public function getIsFragile()
    {
        return $this->isFragile;
    }

    /**
     * Set isCustom
     *
     * @param boolean $isCustom
     *
     * @return Stuff
     */
    public function setIsCustom($isCustom)
    {
        $this->isCustom = $isCustom;

        return $this;
    }

    /**
     * Get isCustom
     *
     * @return bool
     */
    public function getIsCustom()
    {
        return $this->isCustom;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Stuff
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return Stuff
     */
    public function addRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \AppBundle\Entity\Room $room
     */
    public function removeRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set stuffs
     *
     * @param \AppBundle\Entity\Inventory $stuffs
     *
     * @return Stuff
     */
    public function setStuffs(\AppBundle\Entity\Inventory $stuffs = null)
    {
        $this->stuffs = $stuffs;

        return $this;
    }

    /**
     * Get stuffs
     *
     * @return \AppBundle\Entity\Inventory
     */
    public function getStuffs()
    {
        return $this->stuffs;
    }
}
