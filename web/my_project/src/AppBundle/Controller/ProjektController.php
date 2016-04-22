<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Projekt;
use AppBundle\Form\ProjektType;

/**
 * Projekt controller.
 *
 * @Route("/projekt")
 */
class ProjektController extends Controller
{
    /**
     * Lists all Projekt entities.
     *
     * @Route("/", name="projekt_index")
     * @Method("GET")
     */
    public function indexAction()
    {
    	
        $em = $this->getDoctrine()->getManager();

        $projekts = $em->getRepository('AppBundle:Projekt')->findAll();

        return $this->render('projekt/index.html.twig', array(
            'projekts' => $projekts,
        ));
    }

    /**
     * Creates a new Projekt entity.
     *
     * @Route("/new", name="projekt_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projekt = new Projekt();
        $form = $this->createForm('AppBundle\Form\ProjektType', $projekt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projekt);
            $em->flush();

            return $this->redirectToRoute('projekt_show', array('id' => $projekt->getId()));
        }

        return $this->render('projekt/new.html.twig', array(
            'projekt' => $projekt,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Projekt entity.
     *
     * @Route("/{id}", name="projekt_show")
     * @Method("GET")
     */
    public function showAction(Projekt $projekt)
    {
        $deleteForm = $this->createDeleteForm($projekt);

        return $this->render('projekt/show.html.twig', array(
            'projekt' => $projekt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Projekt entity.
     *
     * @Route("/{id}/edit", name="projekt_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projekt $projekt)
    {
        $deleteForm = $this->createDeleteForm($projekt);
        $editForm = $this->createForm('AppBundle\Form\ProjektType', $projekt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projekt);
            $em->flush();

            return $this->redirectToRoute('projekt_edit', array('id' => $projekt->getId()));
        }

        return $this->render('projekt/edit.html.twig', array(
            'projekt' => $projekt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Projekt entity.
     *
     * @Route("/{id}", name="projekt_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projekt $projekt)
    {
        $form = $this->createDeleteForm($projekt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projekt);
            $em->flush();
        }

        return $this->redirectToRoute('projekt_index');
    }

    /**
     * Creates a form to delete a Projekt entity.
     *
     * @param Projekt $projekt The Projekt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projekt $projekt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projekt_delete', array('id' => $projekt->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
