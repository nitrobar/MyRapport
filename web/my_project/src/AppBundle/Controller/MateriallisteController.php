<?php


namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Materialliste;
use AppBundle\Form\MateriallisteType;

/**
 * Materialliste controller.
 *
 * @Route("/materialliste")
 */
class MateriallisteController extends Controller
{
    /**
     * Lists all Materialliste entities.
     *
     * @Route("/", name="materialliste_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materiallistes = $em->getRepository('AppBundle:Materialliste')->findAll();

        return $this->render('materialliste/index.html.twig', array(
            'materiallistes' => $materiallistes,
        ));
    }

    /**
     * Creates a new Materialliste entity.
     *
     * @Route("/new", name="materialliste_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materialliste = new Materialliste();
        $form = $this->createForm('AppBundle\Form\MateriallisteType', $materialliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialliste);
            $em->flush();

            return $this->redirectToRoute('materialliste_show', array('id' => $materialliste->getId()));
        }

        return $this->render('materialliste/new.html.twig', array(
            'materialliste' => $materialliste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Materialliste entity.
     *
     * @Route("/{id}", name="materialliste_show")
     * @Method("GET")
     */
    public function showAction(Materialliste $materialliste)
    {
        $deleteForm = $this->createDeleteForm($materialliste);

        return $this->render('materialliste/show.html.twig', array(
            'materialliste' => $materialliste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Materialliste entity.
     *
     * @Route("/{id}/edit", name="materialliste_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materialliste $materialliste)
    {
        $deleteForm = $this->createDeleteForm($materialliste);
        $editForm = $this->createForm('AppBundle\Form\MateriallisteType', $materialliste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialliste);
            $em->flush();

            return $this->redirectToRoute('materialliste_edit', array('id' => $materialliste->getId()));
        }

        return $this->render('materialliste/edit.html.twig', array(
            'materialliste' => $materialliste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Materialliste entity.
     *
     * @Route("/{id}", name="materialliste_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materialliste $materialliste)
    {
        $form = $this->createDeleteForm($materialliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materialliste);
            $em->flush();
        }

        return $this->redirectToRoute('materialliste_index');
    }

    /**
     * Creates a form to delete a Materialliste entity.
     *
     * @param Materialliste $materialliste The Materialliste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materialliste $materialliste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materialliste_delete', array('id' => $materialliste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
