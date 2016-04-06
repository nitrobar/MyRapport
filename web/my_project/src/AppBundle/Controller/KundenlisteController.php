<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Kundenliste;
use AppBundle\Form\KundenlisteType;

/**
 * Kundenliste controller.
 *
 * @Route("/kundenliste")
 */
class KundenlisteController extends Controller
{
    /**
     * Lists all Kundenliste entities.
     *
     * @Route("/", name="kundenliste_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kundenlistes = $em->getRepository('AppBundle:Kundenliste')->findAll();

        return $this->render('kundenliste/index.html.twig', array(
            'kundenlistes' => $kundenlistes,
        ));
    }

    /**
     * Creates a new Kundenliste entity.
     *
     * @Route("/new", name="kundenliste_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kundenliste = new Kundenliste();
        $form = $this->createForm('AppBundle\Form\KundenlisteType', $kundenliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kundenliste);
            $em->flush();

            return $this->redirectToRoute('kundenliste_show', array('id' => $kundenliste->getId()));
        }

        return $this->render('kundenliste/new.html.twig', array(
            'kundenliste' => $kundenliste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Kundenliste entity.
     *
     * @Route("/{id}", name="kundenliste_show")
     * @Method("GET")
     */
    public function showAction(Kundenliste $kundenliste)
    {
        $deleteForm = $this->createDeleteForm($kundenliste);

        return $this->render('kundenliste/show.html.twig', array(
            'kundenliste' => $kundenliste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Kundenliste entity.
     *
     * @Route("/{id}/edit", name="kundenliste_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kundenliste $kundenliste)
    {
        $deleteForm = $this->createDeleteForm($kundenliste);
        $editForm = $this->createForm('AppBundle\Form\KundenlisteType', $kundenliste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kundenliste);
            $em->flush();

            return $this->redirectToRoute('kundenliste_edit', array('id' => $kundenliste->getId()));
        }

        return $this->render('kundenliste/edit.html.twig', array(
            'kundenliste' => $kundenliste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Kundenliste entity.
     *
     * @Route("/{id}", name="kundenliste_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kundenliste $kundenliste)
    {
        $form = $this->createDeleteForm($kundenliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kundenliste);
            $em->flush();
        }

        return $this->redirectToRoute('kundenliste_index');
    }

    /**
     * Creates a form to delete a Kundenliste entity.
     *
     * @param Kundenliste $kundenliste The Kundenliste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kundenliste $kundenliste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kundenliste_delete', array('id' => $kundenliste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
