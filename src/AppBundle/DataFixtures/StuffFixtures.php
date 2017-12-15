<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 14/12/17
 * Time: 12:39
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use AppBundle\Entity\Stuff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class StuffFixtures extends Fixture implements OrderedFixtureInterface
{
    const STUFF_DEFINITIONS = [
        ['n' => 'Grand carton', 'w' => 55, 'h' => 35, 'd' => 30, 'c' => 'Cartons'],
        ['n' => 'Petit carton', 'w' => 35, 'h' => 27.5, 'd' => 30, 'c' => 'Cartons'],

        ['n' => 'Canapé 2 places', 'c' => 'Canapés'],
        ['n' => 'Canapé 3 places', 'c' => 'Canapés'],
        ['n' => 'Canapé d\'angle', 'c' => 'Canapés'],
        ['n' => 'Clic-clac', 'c' => 'Canapés'],

        ['n' => 'Banc', 'c' => 'Sièges'],
        ['n' => 'Chaise', 'c' => 'Sièges'],
        ['n' => 'Chaise de bureau', 'c' => 'Sièges'],
        ['n' => 'Chaise Haute/ Chaise bébé', 'c' => 'Sièges'],
        ['n' => 'Chaise Pliante', 'c' => 'Sièges'],
        ['n' => 'Chaise PVC/extérieur', 'c' => 'Sièges'],
        ['n' => 'Fauteuil / Méridienne', 'c' => 'Sièges'],
        ['n' => 'Pouf', 'c' => 'Sièges'],
        ['n' => 'Tabouret', 'c' => 'Sièges'],

        ['n' => 'Guéridon / table d\'appoint', 'c' => 'Tables'],
        ['n' => 'Table 2-4 personnes', 'c' => 'Tables'],
        ['n' => 'Table 6-8 personnes', 'c' => 'Tables'],
        ['n' => 'Table monastère en chêne', 'c' => 'Tables'],
        ['n' => 'Table pliante', 'c' => 'Tables'],
        ['n' => 'Table ronde', 'c' => 'Tables'],

        ['n' => 'Halogène', 'c' => 'Luminaires'],
        ['n' => 'Lampe à abat-jour', 'c' => 'Luminaires'],
        ['n' => 'Lustre', 'c' => 'Luminaires'],

        ['n' => 'Aquarium', 'c' => 'Décoration'],
        ['n' => 'Miroir', 'c' => 'Décoration'],
        ['n' => 'Tableau / Cadre', 'c' => 'Décoration'],
        ['n' => 'Tapis', 'c' => 'Décoration'],

        ['n' => 'Armoire 1 porte', 'c' => 'Meubles'],
        ['n' => 'Armoire 2 Portes', 'c' => 'Meubles'],
        ['n' => 'Armoire 3 Portes', 'c' => 'Meubles'],
        ['n' => 'Armoire 4 portes / dressing', 'c' => 'Meubles'],
        ['n' => 'Bar', 'c' => 'Meubles'],
        ['n' => 'Bibliothèque', 'c' => 'Meubles'],
        ['n' => 'Bibliothèque Lourde', 'c' => 'Meubles'],
        ['n' => 'Buffet 2 corps', 'c' => 'Meubles'],
        ['n' => 'Buffet bas', 'c' => 'Meubles'],
        ['n' => 'Bureau', 'c' => 'Meubles'],
        ['n' => 'Caisson de bureau', 'c' => 'Meubles'],
        ['n' => 'Coffre fort (max 200kg)', 'c' => 'Meubles'],
        ['n' => 'Commode', 'c' => 'Meubles'],
        ['n' => 'Console', 'c' => 'Meubles'],
        ['n' => 'Desserte de cuisine', 'c' => 'Meubles'],
        ['n' => 'Elément 1 porte', 'c' => 'Meubles'],
        ['n' => 'Elément 2 portes', 'c' => 'Meubles'],
        ['n' => 'Etagère basse', 'c' => 'Meubles'],
        ['n' => 'Etagère haute', 'c' => 'Meubles'],
        ['n' => 'Horloge comtoise', 'c' => 'Meubles'],
        ['n' => 'Meuble à chaussures', 'c' => 'Meubles'],
        ['n' => 'Meuble TV bas', 'c' => 'Meubles'],
        ['n' => 'Meuble TV haut', 'c' => 'Meubles'],
        ['n' => 'Plan de travail/planches', 'c' => 'Meubles'],
        ['n' => 'Plateau de verre', 'c' => 'Meubles'],
        ['n' => 'Porte-Manteaux', 'c' => 'Meubles'],
        ['n' => 'Secrétaire', 'c' => 'Meubles'],
        ['n' => 'Semainier', 'c' => 'Meubles'],
        ['n' => 'Table à langer', 'c' => 'Meubles'],
        ['n' => 'Table basse', 'c' => 'Meubles'],
        ['n' => 'Table de chevet', 'c' => 'Meubles'],
        ['n' => 'Vaisselier', 'c' => 'Meubles'],
        ['n' => 'Vitrine', 'c' => 'Meubles'],

        ['n' => 'Chaine Hi-Fi / Home cinema', 'c' => 'High tech'],
        ['n' => 'Enceinte HI/FI', 'c' => 'High tech'],
        ['n' => 'Ordinateur', 'c' => 'High tech'],
        ['n' => 'Petite imprimante', 'c' => 'High tech'],
        ['n' => 'Photocopieur bureau', 'c' => 'High tech'],
        ['n' => 'TV', 'c' => 'High tech'],

        ['n' => 'Aspirateur', 'c' => 'Electroménager'],
        ['n' => 'Cave à vin', 'c' => 'Electroménager'],
        ['n' => 'Climatiseur', 'c' => 'Electroménager'],
        ['n' => 'Congélateur', 'c' => 'Electroménager'],
        ['n' => 'Cuisinière', 'c' => 'Electroménager'],
        ['n' => 'Four', 'c' => 'Electroménager'],
        ['n' => 'Four micro-onde', 'c' => 'Electroménager'],
        ['n' => 'Frigo Américain', 'c' => 'Electroménager'],
        ['n' => 'Hotte', 'c' => 'Electroménager'],
        ['n' => 'Lave-Linge', 'c' => 'Electroménager'],
        ['n' => 'Lave-vaisselle', 'c' => 'Electroménager'],
        ['n' => 'Machine/table à coudre', 'c' => 'Electroménager'],
        ['n' => 'Petit électroménager', 'c' => 'Electroménager'],
        ['n' => 'Radiateur', 'c' => 'Electroménager'],
        ['n' => 'Réfrigérateur Top/ Cave à vin', 'c' => 'Electroménager'],
        ['n' => 'Réfrigérateur- Grand', 'c' => 'Electroménager'],
        ['n' => 'Sèche linge', 'c' => 'Electroménager'],
        ['n' => 'Table à repasser', 'c' => 'Electroménager'],
        ['n' => 'Ventilateur', 'c' => 'Electroménager'],

        ['n' => 'Barbecue', 'c' => 'Extérieur'],
        ['n' => 'Brouette', 'c' => 'Extérieur'],
        ['n' => 'Caisse à outils', 'c' => 'Extérieur'],
        ['n' => 'Chaise longue', 'c' => 'Extérieur'],
        ['n' => 'Chaise PVC/extérieur', 'c' => 'Extérieur'],
        ['n' => 'Cheminée', 'c' => 'Extérieur'],
        ['n' => 'Escabeau / Echelle', 'c' => 'Extérieur'],
        ['n' => 'Etabli', 'c' => 'Extérieur'],
        ['n' => 'Grande Plante', 'c' => 'Extérieur'],
        ['n' => 'Jardinière x 4', 'c' => 'Extérieur'],
        ['n' => 'Nettoyeur haute pression', 'c' => 'Extérieur'],
        ['n' => 'Outillage Jardin', 'c' => 'Extérieur'],
        ['n' => 'Parasol', 'c' => 'Extérieur'],
        ['n' => 'Petite Plante', 'c' => 'Extérieur'],
        ['n' => 'Piano droit', 'c' => 'Extérieur'],
        ['n' => 'Pneus de voiture', 'c' => 'Extérieur'],
        ['n' => 'Siège Auto', 'c' => 'Extérieur'],
        ['n' => 'Table de jardin', 'c' => 'Extérieur'],
        ['n' => 'Toboggan', 'c' => 'Extérieur'],
        ['n' => 'Tondeuse', 'c' => 'Extérieur'],
        ['n' => 'Vélo', 'c' => 'Extérieur'],

        ['n' => 'Arbre à chats', 'c' => 'Loisirs'],
        ['n' => 'Babyfoot', 'c' => 'Loisirs'],
        ['n' => 'Balancelle', 'c' => 'Loisirs'],
        ['n' => 'Banc/appareil musculation', 'c' => 'Loisirs'],
        ['n' => 'Billard', 'c' => 'Loisirs'],
        ['n' => 'Canne à pêche', 'c' => 'Loisirs'],
        ['n' => 'Flipper', 'c' => 'Loisirs'],
        ['n' => 'Guitare', 'c' => 'Loisirs'],
        ['n' => 'Harpe', 'c' => 'Loisirs'],
        ['n' => 'Matériel de ski', 'c' => 'Loisirs'],
        ['n' => 'Moto/scooter', 'c' => 'Loisirs'],
        ['n' => 'Moto side-car', 'c' => 'Loisirs'],
        ['n' => 'Piano droit', 'c' => 'Loisirs'],
        ['n' => 'Piano numérique', 'c' => 'Loisirs'],
        ['n' => 'Piano quart de queue', 'c' => 'Loisirs'],
        ['n' => 'Planche de surf', 'c' => 'Loisirs'],
        ['n' => 'Quad', 'c' => 'Loisirs'],
        ['n' => 'Synthétiseur', 'c' => 'Loisirs'],
        ['n' => 'Table de ping pong', 'c' => 'Loisirs'],
        ['n' => 'Tapis de course', 'c' => 'Loisirs'],
        ['n' => 'Vélo d\'appartement', 'c' => 'Loisirs'],

        ['n' => 'Bac de rangement', 'w' => 50, 'h' => 60, 'd' => 40, 'c' => 'Rangements'],
        ['n' => 'Coffre/Malle/Cantine', 'c' => 'Rangements'],
        ['n' => 'Pack 10 bouteille', 'c' => 'Rangements'],
        ['n' => 'Penderie linéaire', 'w' => 50, 'c' => 'Rangements'],
        ['n' => 'Poubelle', 'c' => 'Rangements'],
        ['n' => 'Pousette', 'c' => 'Rangements'],
        ['n' => 'Sèche linge pliable', 'c' => 'Rangements'],
        ['n' => 'Valise', 'c' => 'Rangements'],

        ['n' => 'Chauffeuse', 'c' => 'Literie'],
        ['n' => 'Lit 1 place', 'c' => 'Literie'],
        ['n' => 'Lit 2 places', 'c' => 'Literie'],
        ['n' => 'Lit bébé', 'c' => 'Literie'],
        ['n' => 'Lit mezzanine', 'c' => 'Literie'],
        ['n' => 'Lit pliable', 'c' => 'Literie'],
        ['n' => 'Matelas double', 'c' => 'Literie'],
        ['n' => 'Matelas simple', 'c' => 'Literie'],
        ['n' => 'Sommier double', 'c' => 'Literie'],
        ['n' => 'Sommier simple', 'c' => 'Literie'],
        ['n' => 'Tête de lit', 'c' => 'Literie'],

    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var Category $category
         */
        $category = '';
        foreach (self::STUFF_DEFINITIONS as $def) {
            if (empty($category) || $category->getName() != $def['c']) {
                $category = $manager
                    ->getRepository('AppBundle:Category')
                    ->findOneBy(['name' => $def['c']]);
            }

            $stuff = new Stuff();
            $stuff->setName($def['n']);
            $stuff->setCategory($category);

            if (array_key_exists('h', $def)) {
                $stuff->setDimensionHeight($def['h']);
            }
            if (array_key_exists('w', $def)) {
                $stuff->setDimensionWidth($def['w']);
            }
            if (array_key_exists('d', $def)) {
                $stuff->setDimensionDeep($def['d']);
            }

            $stuff->setIsWeight(false);
            $stuff->setIsCustom(false);
            $stuff->setIsFragile(false);

            $manager->persist($stuff);
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
        return 3;
    }
}