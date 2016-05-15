<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Arbeitsrapport;
use AppBundle\Entity\Stundeneintrag;
use AppBundle\Form\ArbeitsrapportType;


/**
 * Arbeitsrapport controller.
 *
 * @Route("/arbeitsrapport")
 */
class ArbeitsrapportController extends Controller
{
    /**
     * Lists all Arbeitsrapport entities.
     *
     * @Route("/", name="arbeitsrapport_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arbeitsrapports = $em->getRepository('AppBundle:Arbeitsrapport')->findAll();

        return $this->render('arbeitsrapport/index.html.twig', array(
            'arbeitsrapports' => $arbeitsrapports,
        ));
    }

    /**
     * Creates a new Arbeitsrapport entity.
     *
     * @Route("/new", name="arbeitsrapport_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Arbeitsrapport $arbeitsrapportId)
    {
        $arbeitsrapport = new Arbeitsrapport();
        $form = $this->createForm('AppBundle\Form\ArbeitsrapportType', $arbeitsrapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arbeitsrapport);
            $em->flush();

            return $this->redirectToRoute('arbeitsrapport_show', array('id' => $arbeitsrapport->getId()));
        }

        return $this->render('arbeitsrapport/new.html.twig', array(
            'arbeitsrapport' => $arbeitsrapport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Arbeitsrapport entity.
     *
     * @Route("/{id}", name="arbeitsrapport_show")
     * @Method("GET")
     */
    public function showAction(Arbeitsrapport $arbeitsrapport)
    {
    	
    	
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	
    	//------------------------Total Stunden und Total Kosten berechnen------------------------------------------
    	$connection = $em->getConnection();
    	
    	$totalStunden = $connection->prepare("SELECT SUM(std)  FROM stundeneintrag where arbeitsrapportId = :id");
    	$totalStunden->bindValue('id', $arbeitsrapport->getId());
    	$totalStunden->execute();
    	$resultsStunden = $totalStunden->fetchAll();
    	
    	$totalKosten = $connection->prepare("SELECT SUM(total)  FROM stundeneintrag where arbeitsrapportId = :id");
    	$totalKosten->bindValue('id', $arbeitsrapport->getId());
    	$totalKosten->execute();
    	$resultsKosten = $totalKosten->fetchAll();
    	
    	$totalKostenMaterial = $connection->prepare("SELECT SUM(total)  FROM materialeintrag where arbeitsrapportId = :id");
    	$totalKostenMaterial->bindValue('id', $arbeitsrapport->getId());
    	$totalKostenMaterial->execute();
    	$resultsKostenMaterial = $totalKostenMaterial->fetchAll();
    	
    	
    	
    	
    	
    	//----------zeige nur Stundeneinträge zum Pojekt mit der dazugehörigen ArbeitsrapportId an--------------------------
    	$stundeneintrags = $em->getRepository('AppBundle:Stundeneintrag')->findBy(array('arbeitsrapportId' => array($arbeitsrapport)));
    	
    	//----------zeige nur Materialeinträge zum Pojekt mit der dazugehörigen ArbeitsrapportId an--------------------------
    	$materialeintrags = $em->getRepository('AppBundle:Materialeintrag')->findBy(array('arbeitsrapportId' => array($arbeitsrapport)));
	
    	
        $deleteForm = $this->createDeleteForm($arbeitsrapport);

        return $this->render('arbeitsrapport/show.html.twig', array(
            'arbeitsrapport' => $arbeitsrapport,

        	'stundeneintrags' => $stundeneintrags,
        	'materialeintrags' => $materialeintrags,
   			
        	'resultsStunden' => $resultsStunden,
        	'resultsKosten' => $resultsKosten,
        	'resultsKostenMaterial' => $resultsKostenMaterial,
        		
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    
   
    
    
    /**
     * Displays a form to edit an existing Arbeitsrapport entity.
     *
     * @Route("/{id}/edit", name="arbeitsrapport_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Arbeitsrapport $arbeitsrapport)
    {
        $deleteForm = $this->createDeleteForm($arbeitsrapport);
        $editForm = $this->createForm('AppBundle\Form\ArbeitsrapportType', $arbeitsrapport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arbeitsrapport);
            $em->flush();

            return $this->redirectToRoute('arbeitsrapport_edit', array('id' => $arbeitsrapport->getId()));
        }

        return $this->render('arbeitsrapport/edit.html.twig', array(
            'arbeitsrapport' => $arbeitsrapport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Arbeitsrapport entity.
     *
     * @Route("/{id}", name="arbeitsrapport_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Arbeitsrapport $arbeitsrapport)
    {
        $form = $this->createDeleteForm($arbeitsrapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($arbeitsrapport);
            $em->flush();
        }

        return $this->redirectToRoute('arbeitsrapport_index');
    }

    /**
     * Creates a form to delete a Arbeitsrapport entity.
     *
     * @param Arbeitsrapport $arbeitsrapport The Arbeitsrapport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Arbeitsrapport $arbeitsrapport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arbeitsrapport_delete', array('id' => $arbeitsrapport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
