<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inventory;
use AppBundle\Entity\Stuff;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $results = [];

        $em = $this->getDoctrine()->getManager();

        $inventories = $em->getRepository('AppBundle:Inventory')->findAll();

        /**
         * @var Inventory $inventory
         */
        foreach ($inventories as $inventory )
        {
            for ($i = 0; $i < random_int(1, 15); $i++)
            {
                $random = random_int(1, 147);
                $stuff = $this->getDoctrine()->getRepository('AppBundle:Stuff')
                    ->findOneBy(['id' => $random]);

                $inventory->addStuff($stuff);

            }

            /****
             *
             * PARTIE GENERATION A METT DANS VOTRE CONTROLLER DEEP LEARNING
             */

            /**
             * @var Stuff $stuff
             */
            foreach ($inventory->getStuffs() as $stuff)
            {
                if (array_key_exists($stuff->getName(), $results)) {
                    $results[$stuff->getName()] += 1;
                } else {
                    $results[$stuff->getName()] = 1;
                }
            }
        }

        arsort($results);

        return $this->render('home/index.html.twig', array(
            'results' => $results,
        ));
//        $em = $this->getDoctrine()->getManager();
//
//        $rooms = $em->getRepository('AppBundle:Room')->findAll();
//
//        return $this->render('home/index.html.twig', array(
//            'rooms' => $rooms,
//        ));
    }


    public function countInventoryAction(Request $request, Inventory $inventory)
    {

        /**
         *
         * PARTIE GENERATION (A METTRE DANS LES FIXTURES
         */

        $em = $this->getDoctrine()->getManager();
        $inventories = $em->getRepository('AppBundle:Inventory')->findAll();

        /**
         * @var Inventory $inventory
         */
        foreach ($inventories as $inventory ) {
            for ($i = 0; i < random_int(1, 15); $i++) {
                $random = random_int(1, 147);
                /**
                 * @var Stuff $stuff
                 */
                $stuff = $this->getDoctrine()->getRepository('AppBundle:Stuff')
                    ->findOneBy(['id' => $random]);

                $inventory->addStuff($stuff);
            }
        }

        return $this->render('home/index.html.twig', array(
            'inventory' => $inventory,
            'results' => $results,
        ));

    }
}
