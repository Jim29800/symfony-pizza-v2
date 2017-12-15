<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PurchaseProduct;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Purchaseproduct controller.
 *
 * @Route("admin/purchaseproduct")
 */
class PurchaseProductController extends Controller
{
    /**
     * Lists all purchaseProduct entities.
     *
     * @Route("/", name="admin_purchaseproduct_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $purchaseProducts = $em->getRepository('AppBundle:PurchaseProduct')->findAll();

        return $this->render('purchaseproduct/index.html.twig', array(
            'purchaseProducts' => $purchaseProducts,
        ));
    }

    /**
     * Creates a new purchaseProduct entity.
     *
     * @Route("/new", name="admin_purchaseproduct_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $purchaseProduct = new Purchaseproduct();
        $form = $this->createForm('AppBundle\Form\PurchaseProductType', $purchaseProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($purchaseProduct);
            $em->flush();

            return $this->redirectToRoute('admin_purchaseproduct_show', array('id' => $purchaseProduct->getId()));
        }

        return $this->render('purchaseproduct/new.html.twig', array(
            'purchaseProduct' => $purchaseProduct,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a purchaseProduct entity.
     *
     * @Route("/{id}", name="admin_purchaseproduct_show")
     * @Method("GET")
     */
    public function showAction(PurchaseProduct $purchaseProduct)
    {
        $deleteForm = $this->createDeleteForm($purchaseProduct);

        return $this->render('purchaseproduct/show.html.twig', array(
            'purchaseProduct' => $purchaseProduct,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing purchaseProduct entity.
     *
     * @Route("/{id}/edit", name="admin_purchaseproduct_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PurchaseProduct $purchaseProduct)
    {
        $deleteForm = $this->createDeleteForm($purchaseProduct);
        $editForm = $this->createForm('AppBundle\Form\PurchaseProductType', $purchaseProduct);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_purchaseproduct_edit', array('id' => $purchaseProduct->getId()));
        }

        return $this->render('purchaseproduct/edit.html.twig', array(
            'purchaseProduct' => $purchaseProduct,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a purchaseProduct entity.
     *
     * @Route("/{id}", name="admin_purchaseproduct_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PurchaseProduct $purchaseProduct)
    {
        $form = $this->createDeleteForm($purchaseProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($purchaseProduct);
            $em->flush();
        }

        return $this->redirectToRoute('admin_purchaseproduct_index');
    }

    /**
     * Creates a form to delete a purchaseProduct entity.
     *
     * @param PurchaseProduct $purchaseProduct The purchaseProduct entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PurchaseProduct $purchaseProduct)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_purchaseproduct_delete', array('id' => $purchaseProduct->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
