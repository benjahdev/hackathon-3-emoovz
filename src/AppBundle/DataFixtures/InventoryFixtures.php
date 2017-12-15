<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 15/12/17
 * Time: 06:40
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Inventory;
use AppBundle\Entity\Room;
use AppBundle\Entity\Stuff;
use AppBundle\Entity\StuffBasket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InventoryFixtures extends Fixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $stuffs = $manager->getRepository(Stuff::class)
            ->findAll();

        $rooms = $manager->getRepository(Room::class)
            ->findAll();

        for ($i = 0; $i < 150; $i++) {

            $inventory = new Inventory();

            for ($j = 0; $j < random_int(38, 100); $j++)
            {
                $stuff = $stuffs[random_int(0, 146)];

                $stuffBasket = new StuffBasket();
                $stuffBasket->setName($stuff->getName());
                $stuffBasket->setCount(random_int(1, 3));
                $stuffBasket->setDimensionDeep($stuff->getDimensionDeep());
                $stuffBasket->setDimensionHeight($stuff->getDimensionHeight());
                $stuffBasket->setDimensionWidth($stuff->getDimensionWidth());
                $stuffBasket->setIsFragile($stuff->getIsFragile());
                $stuffBasket->setIsWeight($stuff->getIsWeight());
                $stuffBasket->setIsCustom($stuff->getIsCustom());

                $randomRoom = random_int(0, 9);


                $stuffBasket->addRoom($rooms[$randomRoom]);

                $inventory->addBasketStuff($stuffBasket);
            }

            $manager->persist($inventory);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}