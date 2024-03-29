<?php
/**
 * Created by PhpStorm.
 * User: wilder15
 * Date: 14/12/17
 * Time: 13:25
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Inventory;
use AppBundle\Entity\Room;
use AppBundle\Entity\Stuff;
use AppBundle\Entity\StuffBasket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BasketController
 * @package AppBundle\Controller
 * @Route("item")
 */
class BasketController extends Controller
{
    /**
     * @Route("/result", name="item_result")
     */
    public function showDeepLearning()
    {
        $results = [];
        $em = $this->getDoctrine()->getManager();
        $inventories = $em->getRepository('AppBundle:Inventory')->findAll();

        /**
         * @var Inventory $inventory
         */
        foreach ($inventories as $inventory ) {
            /**
             * @var StuffBasket $stuff
             */
            foreach ($inventory->getBasketStuffs() as $stuff) {
                if (array_key_exists($stuff->getName(), $results)) {
                    $results[$stuff->getName()] += $stuff->getCount();
                } else {
                    $results[$stuff->getName()] = 1;
                }
            }
        }
        arsort($results);

        return $this->render('basket/result.html.twig', [
            'results' => $results
        ]);
    }

    public function getStuffsByRoom(Room $room, Inventory $inventory)
    {
        $results = [];

        /**
         * @var StuffBasket $basketStuff
         */
        foreach ($inventory->getBasketStuffs() as $basketStuff) {
            if ($basketStuff->containRooms($room)) {
                $results[] = $basketStuff;
            }
        }

        return $results;
    }
    /**
     * @Route("/room/{id}/inventory/{inventory_id}", name="room_stuffbasket")
     * @ParamConverter("inventory", options={"mapping": {"inventory_id": "id"}})
     */
    public function getInventoryByRoom(Request $request, Room $room, Inventory $inventory)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render('basket/room-inventory.html.twig', array(
                'results' => $this->getStuffsByRoom($room, $inventory),
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }

    /**
     * @Route("/delete-stuff/{id}/inventory/{inventory_id}/room/{room_id}", name="delete_stuffbasket")
     * @ParamConverter("inventory", options={"mapping": {"inventory_id": "id"}})
     * @ParamConverter("room", options={"mapping": {"room_id": "id"}})
     */
    public function deleteStuff(Request $request, StuffBasket $stuffBasket, Inventory $inventory, Room $room)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stuffBasket);
            $em->flush();

            return $this->render('basket/room-inventory.html.twig', array(
                'results' => $this->getStuffsByRoom($room, $inventory),
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }


    /**
     * @Route("/update-stuff-counter/{id}/room/{room_id}/inventory/{inventory_id}/{value}", name="update_stuffbasket_counter")
     * @ParamConverter("room", options={"mapping": {"room_id": "id"}})
     * @ParamConverter("inventory", options={"mapping": {"inventory_id": "id"}})
     */
    public function updateCountOfStuff(
        Request $request, StuffBasket $stuffBasket, Room $room, Inventory $inventory, int $value)
    {
        if ($request->isXmlHttpRequest()) {
            if ($value < 1) {
                $value = 1;
            } elseif ($value > 99) {
                $value = 99;
            }

            $em = $this->getDoctrine()->getManager();

            $stuffBasket->setCount($value);

            $em->persist($stuffBasket);
            $em->flush();

            return $this->render('basket/room-inventory.html.twig', array(
                'results' => $this->getStuffsByRoom($room, $inventory),
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }

    /**
     * @Route("/add/{id}/{room_id}", name="add_stuffbasket")
     * @ParamConverter("room", options={"mapping": {"room_id": "id"}})
     */
    public function addStuffToInventoryAction(Request $request, Stuff $stuff, Room $room)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            /**
             * @var Inventory $inventory
             */
            $inventory = $em->getRepository('AppBundle:Inventory')->findOneBy(array('id' => '1'));
            if (!$inventory->containStuff($stuff)) {

                $stuffBasket = $em->getRepository('AppBundle:StuffBasket')
                    ->findOneBy(array('name' => $stuff->getName()));

                $stuffBasket = new StuffBasket();
                $stuffBasket->setName($stuff->getName());
                $stuffBasket->setCount(1);
                $stuffBasket->setDimensionDeep($stuff->getDimensionDeep());
                $stuffBasket->setDimensionHeight($stuff->getDimensionHeight());
                $stuffBasket->setDimensionWidth($stuff->getDimensionWidth());
                $stuffBasket->setIsFragile($stuff->getIsFragile());
                $stuffBasket->setIsWeight($stuff->getIsWeight());
                $stuffBasket->setIsCustom($stuff->getIsCustom());
                $stuffBasket->addRoom($room);

                $inventory->addBasketStuff($stuffBasket);
                $em->persist($inventory);
                $em->flush();
            } else {
                $stuffBasket = $em->getRepository('AppBundle:StuffBasket')
                    ->findOneBy(array('name' => $stuff->getName()));

                $stuffBasket->setCount($stuffBasket->getCount() + 1);

                if (!$stuffBasket->containRooms($room)) {
                    $stuffBasket->addRoom($room);
                }

                $em->persist($stuffBasket);
                $em->flush();
            }

            return $this->render('basket/room-inventory.html.twig', array(
                'results' => $this->getStuffsByRoom($room, $inventory),
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }
}
