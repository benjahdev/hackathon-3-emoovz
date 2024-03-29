<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inventory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Inventory controller.
 *
 * @Route("inventory")
 */
class InventoryController extends Controller
{
    /**
     * @Route("/{id}/inventory", name="inventory_details")
     */
    public function showUserInventoryAction(Inventory $inventory)
    {
        return $this->render('basket/index.html.twig', [
            'inventory' => $inventory
        ]);
    }

    /**
     * Lists all inventory entities.
     *
     * @Route("/", name="inventory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inventories = $em->getRepository('AppBundle:Inventory')->findAll();

        return $this->render('inventory/index.html.twig', array(
            'inventories' => $inventories,
        ));
    }

    /**
     * Creates a new inventory entity.
     *
     * @Route("/new", name="inventory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $inventory = new Inventory();
        $form = $this->createForm('AppBundle\Form\InventoryType', $inventory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inventory);
            $em->flush();

            return $this->redirectToRoute('inventory_show', array('id' => $inventory->getId()));
        }

        return $this->render('inventory/new.html.twig', array(
            'inventory' => $inventory,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a inventory entity.
     *
     * @Route("/{id}", name="inventory_show")
     * @Method("GET")
     */
    public function showAction(Inventory $inventory)
    {
        $deleteForm = $this->createDeleteForm($inventory);

        return $this->render('inventory/show.html.twig', array(
            'inventory' => $inventory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing inventory entity.
     *
     * @Route("/{id}/edit", name="inventory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Inventory $inventory)
    {
        $deleteForm = $this->createDeleteForm($inventory);
        $editForm = $this->createForm('AppBundle\Form\InventoryType', $inventory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventory_edit', array('id' => $inventory->getId()));
        }

        return $this->render('inventory/edit.html.twig', array(
            'inventory' => $inventory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a inventory entity.
     *
     * @Route("/{id}", name="inventory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Inventory $inventory)
    {
        $form = $this->createDeleteForm($inventory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inventory);
            $em->flush();
        }

        return $this->redirectToRoute('inventory_index');
    }

    /**
     * Creates a form to delete a inventory entity.
     *
     * @param Inventory $inventory The inventory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inventory $inventory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inventory_delete', array('id' => $inventory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
