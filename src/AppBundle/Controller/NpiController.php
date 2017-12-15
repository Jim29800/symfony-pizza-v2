<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Npi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Npi controller.
 *
 * @Route("admin/npi")
 */
class NpiController extends Controller
{
    /**
     * Lists all npi entities.
     *
     * @Route("/", name="admin_npi_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $npis = $em->getRepository('AppBundle:Npi')->findAll();

        return $this->render('npi/index.html.twig', array(
            'npis' => $npis,
        ));
    }

    /**
     * Creates a new npi entity.
     *
     * @Route("/new", name="admin_npi_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $npi = new Npi();
        $form = $this->createForm('AppBundle\Form\NpiType', $npi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($npi);
            $em->flush();

            return $this->redirectToRoute('admin_npi_show', array('id' => $npi->getId()));
        }

        return $this->render('npi/new.html.twig', array(
            'npi' => $npi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a npi entity.
     *
     * @Route("/{id}", name="admin_npi_show")
     * @Method("GET")
     */
    public function showAction(Npi $npi)
    {
        $deleteForm = $this->createDeleteForm($npi);

        return $this->render('npi/show.html.twig', array(
            'npi' => $npi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing npi entity.
     *
     * @Route("/{id}/edit", name="admin_npi_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Npi $npi)
    {
        $deleteForm = $this->createDeleteForm($npi);
        $editForm = $this->createForm('AppBundle\Form\NpiType', $npi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_npi_edit', array('id' => $npi->getId()));
        }

        return $this->render('npi/edit.html.twig', array(
            'npi' => $npi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a npi entity.
     *
     * @Route("/{id}", name="admin_npi_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Npi $npi)
    {
        $form = $this->createDeleteForm($npi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($npi);
            $em->flush();
        }

        return $this->redirectToRoute('admin_npi_index');
    }

    /**
     * Creates a form to delete a npi entity.
     *
     * @param Npi $npi The npi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Npi $npi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_npi_delete', array('id' => $npi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
