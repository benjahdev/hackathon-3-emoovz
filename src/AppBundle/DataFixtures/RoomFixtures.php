<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 14/12/17
 * Time: 12:00
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements OrderedFixtureInterface
{
    const ROOM_NAMES = [
        'Cuisine',
        'Entrée',
        'Salon',
        'Salle à manger',
        'Salle de bain',
        'Chambre',
        'Bureau',
        'Cave',
        'Jardin/Balcon',
        'Garage',
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::ROOM_NAMES as $roomName) {
            $room = new Room();
            $room->setName($roomName);

            $manager->persist($room);
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
        return 2;
    }
}