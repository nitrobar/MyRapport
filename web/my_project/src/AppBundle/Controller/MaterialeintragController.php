<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Materialeintrag;
use AppBundle\Form\MaterialeintragType;

/**
 * Materialeintrag controller.
 *
 * @Route("/materialeintrag")
 */
class MaterialeintragController extends Controller
{
    /**
     * Lists all Materialeintrag entities.
     *
     * @Route("/", name="materialeintrag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materialeintrags = $em->getRepository('AppBundle:Materialeintrag')->findAll();

        return $this->render('materialeintrag/index.html.twig', array(
            'materialeintrags' => $materialeintrags,
        ));
    }

    /**
     * Creates a new Materialeintrag entity.
     *
     * @Route("/new", name="materialeintrag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materialeintrag = new Materialeintrag();
        $form = $this->createForm('AppBundle\Form\MaterialeintragType', $materialeintrag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //--------------------Daten von Material auslesen-----------------------------------------
            $material_auswahl = $form->get('materialliste')->getData();
            $name = $material_auswahl->getName();
            
            
            $material = $em->getRepository('AppBundle:Material')->findOneBy(array('typ' => $name));
            $materialeintrag->setBetragProAnzahl($material->getPreis());
            //--------------------Daten von Material auslesen----------------------------------------
            
            //--------------------total berechen----------------------------------------------
            $anzahl = $form->get('anzahl')->getData();
            $total = $anzahl*$material->getPreis();
            $materialeintrag->setTotal($total);
            //--------------------total berechen----------------------------------------------
            
            $em->persist($materialeintrag);
            $em->flush();

            return $this->redirectToRoute('materialeintrag_show', array('id' => $materialeintrag->getId()));
        }

        return $this->render('materialeintrag/new.html.twig', array(
            'materialeintrag' => $materialeintrag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Materialeintrag entity.
     *
     * @Route("/{id}", name="materialeintrag_show")
     * @Method("GET")
     */
    public function showAction(Materialeintrag $materialeintrag)
    {
        $deleteForm = $this->createDeleteForm($materialeintrag);

        return $this->render('materialeintrag/show.html.twig', array(
            'materialeintrag' => $materialeintrag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Materialeintrag entity.
     *
     * @Route("/{id}/edit", name="materialeintrag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materialeintrag $materialeintrag)
    {
        $deleteForm = $this->createDeleteForm($materialeintrag);
        $editForm = $this->createForm('AppBundle\Form\MaterialeintragType', $materialeintrag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialeintrag);
            $em->flush();

            return $this->redirectToRoute('materialeintrag_edit', array('id' => $materialeintrag->getId()));
        }

        return $this->render('materialeintrag/edit.html.twig', array(
            'materialeintrag' => $materialeintrag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Materialeintrag entity.
     *
     * @Route("/{id}", name="materialeintrag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materialeintrag $materialeintrag)
    {
        $form = $this->createDeleteForm($materialeintrag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materialeintrag);
            $em->flush();
        }

        return $this->redirectToRoute('materialeintrag_index');
    }

    /**
     * Creates a form to delete a Materialeintrag entity.
     *
     * @param Materialeintrag $materialeintrag The Materialeintrag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materialeintrag $materialeintrag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materialeintrag_delete', array('id' => $materialeintrag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
