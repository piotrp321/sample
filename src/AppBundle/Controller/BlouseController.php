<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blouse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Blouse controller.
 *
 * @Route("blouse")
 */
class BlouseController extends Controller
{
    /**
     * Lists all blouse entities.
     *
     * @Route("/", name="blouse_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blouses = $em->getRepository('AppBundle:Blouse')->findAll();

        $deleteForms = array();
        foreach ($blouses as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity)->createView();
        }

        return $this->render('blouse/index.html.twig', array(
            'blouses' => $blouses,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new blouse entity.
     *
     * @Route("/new", name="blouse_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blouse = new Blouse();
        $form = $this->createForm('AppBundle\Form\BlouseType', $blouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blouse);
            $em->flush();

            return $this->redirectToRoute('blouse_show', array('id' => $blouse->getId()));
        }

        return $this->render('blouse/new.html.twig', array(
            'blouse' => $blouse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blouse entity.
     *
     * @Route("/{id}", name="blouse_show")
     * @Method("GET")
     */
    public function showAction(Blouse $blouse)
    {
        $deleteForm = $this->createDeleteForm($blouse);

        return $this->render('blouse/show.html.twig', array(
            'blouse' => $blouse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing blouse entity.
     *
     * @Route("/{id}/edit", name="blouse_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blouse $blouse)
    {
        $deleteForm = $this->createDeleteForm($blouse);
        $editForm = $this->createForm('AppBundle\Form\BlouseType', $blouse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blouse_edit', array('id' => $blouse->getId()));
        }

        return $this->render('blouse/edit.html.twig', array(
            'blouse' => $blouse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blouse entity.
     *
     * @Route("/{id}", name="blouse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blouse $blouse)
    {
        $form = $this->createDeleteForm($blouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blouse);
            $em->flush();
        }

        return $this->redirectToRoute('blouse_index');
    }

    /**
     * Creates a form to delete a blouse entity.
     *
     * @param Blouse $blouse The blouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blouse $blouse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blouse_delete', array('id' => $blouse->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
