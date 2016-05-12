<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Kunde;
use AppBundle\Form\KundeType;
use AppBundle\Entity\Kundenliste;

/**
 * Kunde controller.
 *
 * @Route("/kunden")
 */
class KundeController extends Controller
{
    /**
     * Lists all Kunde entities.
     *
     * @Route("/", name="kunde_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kundes = $em->getRepository('AppBundle:Kunde')->findAll();

        return $this->render('kunde/index.html.twig', array(
            'kundes' => $kundes,
        ));
    }

    /**
     * Creates a new Kunde entity.
     *
     * @Route("/new", name="kunde_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kunde = new Kunde();   
        
        $form = $this->createForm('AppBundle\Form\KundeType', $kunde);
        $form->handleRequest($request);
        
//---------------------neu----------------------------------------------------
        $kundenliste = new Kundenliste();
		
        $name = $form->get('name')->getData();	
		$kundenliste->setName($name);	
	
		$adresse = $form->get('adresse')->getData();
		$kundenliste->setAdresse($adresse);
		
		$ort = $form->get('ort')->getData();
		$kundenliste->setOrt($ort);
		
		$telefon = $form->get('telefon')->getData();
		$kundenliste->setTelefon($telefon);
//---------------------neu----------------------------------------------------
               
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kunde);
            
//---------------------neu----------------------------------------------------
            $em->persist($kundenliste);
//---------------------neu----------------------------------------------------

            $em->flush();
            
            return $this->redirectToRoute('kunde_show', array('id' => $kunde->getId()));
        }

        return $this->render('kunde/new.html.twig', array(
            'kunde' => $kunde,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Kunde entity.
     *
     * @Route("/{id}", name="kunde_show")
     * @Method("GET")
     */
    
    public function showAction(Kunde $kunde)
    {
       $deleteForm = $this->createDeleteForm($kunde);

        return $this->render('kunde/show.html.twig', array(
            'kunde' => $kunde,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Kunde entity.
     *
     * @Route("/{id}/edit", name="kunde_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kunde $kunde)
    {
        $deleteForm = $this->createDeleteForm($kunde);
        $editForm = $this->createForm('AppBundle\Form\KundeType', $kunde);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kunde);
            $em->flush();

            return $this->redirectToRoute('kunde_edit', array('id' => $kunde->getId()));
        }

        return $this->render('kunde/edit.html.twig', array(
            'kunde' => $kunde,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Kunde entity.
     *
     * @Route("/{id}", name="kunde_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kunde $kunde)
    {
        $form = $this->createDeleteForm($kunde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kunde);
            $em->flush();
        }

        return $this->redirectToRoute('kunde_index');
    }

    /**
     * Creates a form to delete a Kunde entity.
     *
     * @param Kunde $kunde The Kunde entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kunde $kunde)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kunde_delete', array('id' => $kunde->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
