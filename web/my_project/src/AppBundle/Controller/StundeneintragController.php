<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Stundeneintrag;
use AppBundle\Form\StundeneintragType;
use AppBundle\Entity\Mitarbeiterliste;

/**
 * Stundeneintrag controller.
 *
 * @Route("/stundeneintrag")
 */
class StundeneintragController extends Controller
{
    /**
     * Lists all Stundeneintrag entities.
     *
     * @Route("/", name="stundeneintrag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stundeneintrags = $em->getRepository('AppBundle:Stundeneintrag')->findAll();

        return $this->render('stundeneintrag/index.html.twig', array(
            'stundeneintrags' => $stundeneintrags,
        ));
    }

    /**
     * Creates a new Stundeneintrag entity.
     *
     * @Route("/new", name="stundeneintrag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $stundeneintrag = new Stundeneintrag();
        $form = $this->createForm('AppBundle\Form\StundeneintragType', $stundeneintrag);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
//--------------------Daten von Mitarbeiter auslesen-----------------------------------------
            $mitarbeiter_auswahl = $form->get('mitarbeiterliste')->getData();
            $id = $mitarbeiter_auswahl->getId();
            
            
            $mitarbeiter = $em->getRepository('AppBundle:Mitarbeiter')->findOneBy(array('id' => $id));
            $stundeneintrag->setBeitragProStd($mitarbeiter->getStundenansatz());
//--------------------Daten von Mitarbeiter auslesen----------------------------------------
          
//--------------------total berechen----------------------------------------------
            $std = $form->get('std')->getData();
            $total = $std*$mitarbeiter->getStundenansatz();
            $stundeneintrag->setTotal($total);
//--------------------total berechen----------------------------------------------
            
            $em->persist($stundeneintrag);
            $em->flush();

            return $this->redirectToRoute('stundeneintrag_show', array('id' => $stundeneintrag->getId()));
        }

        return $this->render('stundeneintrag/new.html.twig', array(
            'stundeneintrag' => $stundeneintrag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Stundeneintrag entity.
     *
     * @Route("/{id}", name="stundeneintrag_show")
     * @Method("GET")
     */
    public function showAction(Stundeneintrag $stundeneintrag)
    {
        $deleteForm = $this->createDeleteForm($stundeneintrag);

        return $this->render('stundeneintrag/show.html.twig', array(
            'stundeneintrag' => $stundeneintrag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stundeneintrag entity.
     *
     * @Route("/{id}/edit", name="stundeneintrag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stundeneintrag $stundeneintrag)
    {
        $deleteForm = $this->createDeleteForm($stundeneintrag);
        $editForm = $this->createForm('AppBundle\Form\StundeneintragType', $stundeneintrag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stundeneintrag);
            $em->flush();

            return $this->redirectToRoute('stundeneintrag_edit', array('id' => $stundeneintrag->getId()));
        }

        return $this->render('stundeneintrag/edit.html.twig', array(
            'stundeneintrag' => $stundeneintrag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Stundeneintrag entity.
     *
     * @Route("/{id}", name="stundeneintrag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Stundeneintrag $stundeneintrag)
    {
        $form = $this->createDeleteForm($stundeneintrag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stundeneintrag);
            $em->flush();
        }

        return $this->redirectToRoute('stundeneintrag_index');
    }

    /**
     * Creates a form to delete a Stundeneintrag entity.
     *
     * @param Stundeneintrag $stundeneintrag The Stundeneintrag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stundeneintrag $stundeneintrag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stundeneintrag_delete', array('id' => $stundeneintrag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
