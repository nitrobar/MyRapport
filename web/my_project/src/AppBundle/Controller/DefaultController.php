<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Kundenliste;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
   
   /* 
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    */
    
    public function createAction()
    {
    	$kundenliste = new Kundenliste();
    	$kundenliste->setName('Fritz Fischer');
    	$kundenliste->setAdresse('Fischerstrasse 8');
    	$kundenliste->setOrt('Landquart');
    	$kundenliste->setTelefon('0813437854');
    	
    	$em = $this->getDoctrine()->getManager();
   
    	// tells Doctrine you want to (eventually) save the Product (no queries yet)
    	$em->persist($kundenliste);
    
    	// actually executes the queries (i.e. the INSERT query)
    	$em->flush();
    
    	return new Response('Saved new product with id '.$kundenliste->getId());
    }
}
