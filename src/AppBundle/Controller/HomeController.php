<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stuff;
use AppBundle\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        $inventory = $this->getDoctrine()->getRepository('AppBundle:Inventory')->findOneBy(['id' => 1]);

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'inventory' => $inventory,
        ]);
    }

}
