<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table(name="object")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObjectRepository")
 */
class Object
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
     * @ORM\Column(name="dimension_height", type="integer")
     */
    private $dimensionHeight;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_width", type="integer")
     */
    private $dimensionWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_deep", type="integer")
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
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * @return Object
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
}

