<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Materialeintragliste;
use AppBundle\Form\MaterialeintraglisteType;

/**
 * Materialeintragliste controller.
 *
 * @Route("/materialeintragliste")
 */
class MaterialeintraglisteController extends Controller
{
    /**
     * Lists all Materialeintragliste entities.
     *
     * @Route("/", name="materialeintragliste_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materialeintraglistes = $em->getRepository('AppBundle:Materialeintragliste')->findAll();

        return $this->render('materialeintragliste/index.html.twig', array(
            'materialeintraglistes' => $materialeintraglistes,
        ));
    }

    /**
     * Creates a new Materialeintragliste entity.
     *
     * @Route("/new", name="materialeintragliste_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materialeintragliste = new Materialeintragliste();
        $form = $this->createForm('AppBundle\Form\MaterialeintraglisteType', $materialeintragliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialeintragliste);
            $em->flush();

            return $this->redirectToRoute('materialeintragliste_show', array('id' => $materialeintragliste->getId()));
        }

        return $this->render('materialeintragliste/new.html.twig', array(
            'materialeintragliste' => $materialeintragliste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Materialeintragliste entity.
     *
     * @Route("/{id}", name="materialeintragliste_show")
     * @Method("GET")
     */
    public function showAction(Materialeintragliste $materialeintragliste)
    {
        $deleteForm = $this->createDeleteForm($materialeintragliste);

        return $this->render('materialeintragliste/show.html.twig', array(
            'materialeintragliste' => $materialeintragliste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Materialeintragliste entity.
     *
     * @Route("/{id}/edit", name="materialeintragliste_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materialeintragliste $materialeintragliste)
    {
        $deleteForm = $this->createDeleteForm($materialeintragliste);
        $editForm = $this->createForm('AppBundle\Form\MaterialeintraglisteType', $materialeintragliste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialeintragliste);
            $em->flush();

            return $this->redirectToRoute('materialeintragliste_edit', array('id' => $materialeintragliste->getId()));
        }

        return $this->render('materialeintragliste/edit.html.twig', array(
            'materialeintragliste' => $materialeintragliste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Materialeintragliste entity.
     *
     * @Route("/{id}", name="materialeintragliste_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materialeintragliste $materialeintragliste)
    {
        $form = $this->createDeleteForm($materialeintragliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materialeintragliste);
            $em->flush();
        }

        return $this->redirectToRoute('materialeintragliste_index');
    }

    /**
     * Creates a form to delete a Materialeintragliste entity.
     *
     * @param Materialeintragliste $materialeintragliste The Materialeintragliste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materialeintragliste $materialeintragliste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materialeintragliste_delete', array('id' => $materialeintragliste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
