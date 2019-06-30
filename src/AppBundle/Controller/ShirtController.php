<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shirt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Shirt controller.
 *
 * @Route("shirt")
 */
class ShirtController extends Controller
{
    /**
     * Lists all shirt entities.
     *
     * @Route("/", name="shirt_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shirts = $em->getRepository('AppBundle:Shirt')->findAll();

        $deleteForms = array();
        foreach ($shirts as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity)->createView();
        }

        return $this->render('shirt/index.html.twig', array(
            'shirts' => $shirts,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new shirt entity.
     *
     * @Route("/new", name="shirt_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $shirt = new Shirt();
        $form = $this->createForm('AppBundle\Form\ShirtType', $shirt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shirt);
            $em->flush();

            return $this->redirectToRoute('shirt_show', array('id' => $shirt->getId()));
        }

        return $this->render('shirt/new.html.twig', array(
            'shirt' => $shirt,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a shirt entity.
     *
     * @Route("/{id}", name="shirt_show")
     * @Method("GET")
     */
    public function showAction(Shirt $shirt)
    {
        $deleteForm = $this->createDeleteForm($shirt);

        return $this->render('shirt/show.html.twig', array(
            'shirt' => $shirt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing shirt entity.
     *
     * @Route("/{id}/edit", name="shirt_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Shirt $shirt)
    {
        $deleteForm = $this->createDeleteForm($shirt);
        $editForm = $this->createForm('AppBundle\Form\ShirtType', $shirt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shirt_edit', array('id' => $shirt->getId()));
        }

        return $this->render('shirt/edit.html.twig', array(
            'shirt' => $shirt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a shirt entity.
     *
     * @Route("/{id}", name="shirt_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Shirt $shirt)
    {
        $form = $this->createDeleteForm($shirt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shirt);
            $em->flush();
        }

        return $this->redirectToRoute('shirt_index');
    }

    /**
     * Creates a form to delete a shirt entity.
     *
     * @param Shirt $shirt The shirt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Shirt $shirt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('shirt_delete', array('id' => $shirt->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
