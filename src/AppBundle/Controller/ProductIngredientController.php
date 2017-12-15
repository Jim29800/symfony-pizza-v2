<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductIngredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Productingredient controller.
 *
 * @Route("admin/productingredient")
 */
class ProductIngredientController extends Controller
{
    /**
     * Lists all productIngredient entities.
     *
     * @Route("/", name="admin_productingredient_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productIngredients = $em->getRepository('AppBundle:ProductIngredient')->findAll();

        return $this->render('productingredient/index.html.twig', array(
            'productIngredients' => $productIngredients,
        ));
    }

    /**
     * Creates a new productIngredient entity.
     *
     * @Route("/new", name="admin_productingredient_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productIngredient = new Productingredient();
        $form = $this->createForm('AppBundle\Form\ProductIngredientType', $productIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productIngredient);
            $em->flush();

            return $this->redirectToRoute('admin_productingredient_show', array('id' => $productIngredient->getId()));
        }

        return $this->render('productingredient/new.html.twig', array(
            'productIngredient' => $productIngredient,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productIngredient entity.
     *
     * @Route("/{id}", name="admin_productingredient_show")
     * @Method("GET")
     */
    public function showAction(ProductIngredient $productIngredient)
    {
        $deleteForm = $this->createDeleteForm($productIngredient);

        return $this->render('productingredient/show.html.twig', array(
            'productIngredient' => $productIngredient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productIngredient entity.
     *
     * @Route("/{id}/edit", name="admin_productingredient_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductIngredient $productIngredient)
    {
        $deleteForm = $this->createDeleteForm($productIngredient);
        $editForm = $this->createForm('AppBundle\Form\ProductIngredientType', $productIngredient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_productingredient_edit', array('id' => $productIngredient->getId()));
        }

        return $this->render('productingredient/edit.html.twig', array(
            'productIngredient' => $productIngredient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productIngredient entity.
     *
     * @Route("/{id}", name="admin_productingredient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductIngredient $productIngredient)
    {
        $form = $this->createDeleteForm($productIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productIngredient);
            $em->flush();
        }

        return $this->redirectToRoute('admin_productingredient_index');
    }

    /**
     * Creates a form to delete a productIngredient entity.
     *
     * @param ProductIngredient $productIngredient The productIngredient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductIngredient $productIngredient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_productingredient_delete', array('id' => $productIngredient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
