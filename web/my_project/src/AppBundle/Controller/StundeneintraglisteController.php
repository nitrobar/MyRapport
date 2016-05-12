<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Stundeneintragliste;
use AppBundle\Form\StundeneintraglisteType;

/**
 * Stundeneintragliste controller.
 *
 * @Route("/stundeneintragliste")
 */
class StundeneintraglisteController extends Controller
{
    /**
     * Lists all Stundeneintragliste entities.
     *
     * @Route("/", name="stundeneintragliste_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stundeneintraglistes = $em->getRepository('AppBundle:Stundeneintragliste')->findAll();

        return $this->render('stundeneintragliste/index.html.twig', array(
            'stundeneintraglistes' => $stundeneintraglistes,
        ));
    }

    /**
     * Creates a new Stundeneintragliste entity.
     *
     * @Route("/new", name="stundeneintragliste_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $stundeneintragliste = new Stundeneintragliste();
        $form = $this->createForm('AppBundle\Form\StundeneintraglisteType', $stundeneintragliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stundeneintragliste);
            $em->flush();

            return $this->redirectToRoute('stundeneintragliste_show', array('id' => $stundeneintragliste->getId()));
        }

        return $this->render('stundeneintragliste/new.html.twig', array(
            'stundeneintragliste' => $stundeneintragliste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Stundeneintragliste entity.
     *
     * @Route("/{id}", name="stundeneintragliste_show")
     * @Method("GET")
     */
    public function showAction(Stundeneintragliste $stundeneintragliste)
    {
        $deleteForm = $this->createDeleteForm($stundeneintragliste);

        return $this->render('stundeneintragliste/show.html.twig', array(
            'stundeneintragliste' => $stundeneintragliste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stundeneintragliste entity.
     *
     * @Route("/{id}/edit", name="stundeneintragliste_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stundeneintragliste $stundeneintragliste)
    {
        $deleteForm = $this->createDeleteForm($stundeneintragliste);
        $editForm = $this->createForm('AppBundle\Form\StundeneintraglisteType', $stundeneintragliste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stundeneintragliste);
            $em->flush();

            return $this->redirectToRoute('stundeneintragliste_edit', array('id' => $stundeneintragliste->getId()));
        }

        return $this->render('stundeneintragliste/edit.html.twig', array(
            'stundeneintragliste' => $stundeneintragliste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Stundeneintragliste entity.
     *
     * @Route("/{id}", name="stundeneintragliste_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Stundeneintragliste $stundeneintragliste)
    {
        $form = $this->createDeleteForm($stundeneintragliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stundeneintragliste);
            $em->flush();
        }

        return $this->redirectToRoute('stundeneintragliste_index');
    }

    /**
     * Creates a form to delete a Stundeneintragliste entity.
     *
     * @param Stundeneintragliste $stundeneintragliste The Stundeneintragliste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stundeneintragliste $stundeneintragliste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stundeneintragliste_delete', array('id' => $stundeneintragliste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
