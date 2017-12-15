<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 14/12/17
 * Time: 11:27
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    const CATEGORY_NAMES = [
        'Cartons',
        'Canapés',
        'Sièges',
        'Tables',
        'Luminaires',
        'Décoration',
        'Meubles',
        'High tech',
        'Electroménager',
        'Extérieur',
        'Loisirs',
        'Rangements',
        'Literie',
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORY_NAMES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
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
        return 1;
    }
}