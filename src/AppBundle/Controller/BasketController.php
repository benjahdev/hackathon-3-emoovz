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
     * @Route("/delete-stuff/{id}/inventory/{inventory_id}", name="delete_stuffbasket")
     * @ParamConverter("inventory", options={"mapping": {"inventory_id": "id"}})
     */
    public function deleteStuff(Request $request, StuffBasket $stuffBasket, Inventory $inventory)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stuffBasket);
            $em->flush();

            return $this->render('basket/index.html.twig', array(
                'inventory' => $inventory,
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }


    /**
     * @Route("/update-stuff-counter/{id}/inventory/{inventory_id}/{value}", name="update_stuffbasket_counter")
     * @ParamConverter("inventory", options={"mapping": {"inventory_id": "id"}})
     */
    public function updateCountOfStuff(Request $request, StuffBasket $stuffBasket, Inventory $inventory, int $value)
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

            return $this->render('basket/index.html.twig', array(
                'inventory' => $inventory,
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

            return $this->render('basket/index.html.twig', array(
                'inventory' => $inventory,
            ));
        } else {
            throw new HttpException('500','^_^');
        }
    }

}