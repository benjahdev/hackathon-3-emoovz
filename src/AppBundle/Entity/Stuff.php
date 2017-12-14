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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="stuffs")
     */
    private $category;

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
     * @param float $dimensionHeight
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
     * @return boolean
     */
    public function getIsCustom()
    {
        return $this->isCustom;
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
}
