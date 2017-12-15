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
        $selected = new Room();
        $em = $this->getDoctrine()->getManager();
        $rooms = $em->getRepository('AppBundle:Room')->findAll();
        $form = $this->createForm('AppBundle\Form\SelectedType', $selected);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('home/index.html.twig', array(
            'rooms' => $rooms,
            'form' => $form->createView(),
        ));
    }

}
