<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StuffBasket
 *
 * @ORM\Table(name="stuff_basket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StuffBasketRepository")
 */
class StuffBasket
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
     * @var float
     *
     * @ORM\Column(name="dimension_height", type="float", nullable=true)
     */
    private $dimensionHeight;

    /**
     * @var float
     *
     * @ORM\Column(name="dimension_width", type="float", nullable=true)
     */
    private $dimensionWidth;

    /**
     * @var float
     *
     * @ORM\Column(name="dimension_deep", type="float", nullable=true)
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
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private  $count;


    /**
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="stuffs")
     */
    private $rooms;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return StuffBasket
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
     * @param float $dimensionHeight
     *
     * @return StuffBasket
     */
    public function setDimensionHeight($dimensionHeight)
    {
        $this->dimensionHeight = $dimensionHeight;

        return $this;
    }

    /**
     * Get dimensionHeight
     *
     * @return float
     */
    public function getDimensionHeight()
    {
        return $this->dimensionHeight;
    }

    /**
     * Set dimensionWidth
     *
     * @param float $dimensionWidth
     *
     * @return StuffBasket
     */
    public function setDimensionWidth($dimensionWidth)
    {
        $this->dimensionWidth = $dimensionWidth;

        return $this;
    }

    /**
     * Get dimensionWidth
     *
     * @return float
     */
    public function getDimensionWidth()
    {
        return $this->dimensionWidth;
    }

    /**
     * Set dimensionDeep
     *
     * @param float $dimensionDeep
     *
     * @return StuffBasket
     */
    public function setDimensionDeep($dimensionDeep)
    {
        $this->dimensionDeep = $dimensionDeep;

        return $this;
    }

    /**
     * Get dimensionDeep
     *
     * @return float
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
     * @return StuffBasket
     */
    public function setIsWeight($isWeight)
    {
        $this->isWeight = $isWeight;

        return $this;
    }

    /**
     * Get isWeight
     *
     * @return boolean
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
     * @return StuffBasket
     */
    public function setIsFragile($isFragile)
    {
        $this->isFragile = $isFragile;

        return $this;
    }

    /**
     * Get isFragile
     *
     * @return boolean
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
     * @return StuffBasket
     */
    public function setIsCustom($isCustom)
    {
        $this->isCustom = $isCustom;

        return $this;
    }

    /**
     * Get isCustom
     *
     * @return boolean
     */
    public function getIsCustom()
    {
        return $this->isCustom;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return StuffBasket
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Add room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return StuffBasket
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

    public function containRooms(Room $room)
    {
        $found = false;
        foreach ($this->getRooms() as $roomEntity) {
            if ($roomEntity->getId() == $room->getId()) {
                $found = true;
                break;
            }
        }

        return $found;
    }
}
