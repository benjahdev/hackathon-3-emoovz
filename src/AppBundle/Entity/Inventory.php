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
     * @ORM\ManyToMany(targetEntity="StuffBasket", cascade={"persist"})
     */
    private $basketStuffs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->basketStuffs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add basketStuff
     *
     * @param \AppBundle\Entity\StuffBasket $basketStuff
     *
     * @return Inventory
     */
    public function addBasketStuff(\AppBundle\Entity\StuffBasket $basketStuff)
    {
        $this->basketStuffs[] = $basketStuff;

        return $this;
    }

    /**
     * Remove basketStuff
     *
     * @param \AppBundle\Entity\StuffBasket $basketStuff
     */
    public function removeBasketStuff(\AppBundle\Entity\StuffBasket $basketStuff)
    {
        $this->basketStuffs->removeElement($basketStuff);
    }

    /**
     * Get basketStuffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBasketStuffs()
    {
        return $this->basketStuffs;
    }

    public function containStuff(StuffBasket $stuff)
    {
        $found = false;
        foreach ($this->getBasketStuffs() as $stuffEntity) {
            if ($stuffEntity->getId() == $stuff->getId()) {
                $found = true;
                break;
            }
        }

        return $found;
    }
}
