<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Kundenliste;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreateKundenController extends Controller
{
	/**
	 * @Route("kunden/create")
	 */
	
	public function newAction(Request $request)
	{
		// create a task and give it some dummy data for this example
		$kunde = new Kundenliste();
		/*
		$kunde->setName('John');
		$kunde->setOrt('Ems');
		$kunde->setAdresse('Bahnhofstrasse 22');
		$kunde->setTelefon('0813535539');
		*/

		$form = $this->createFormBuilder($kunde)
		->add('Name', TextType::class)
		->add('Ort', TextType::class)
		->add('Adresse', TextType::class)
		->add('Telefon', TextType::class)
		->add('save', SubmitType::class, array('label' => 'Create Kunde'))
		->getForm();

		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			// ... perform some action, such as saving the task to the database
		
			
			$em = $this->getDoctrine()->getManager();
			 
			// tells Doctrine you want to (eventually) save the Product (no queries yet)
			$em->persist($kunde);
			
			// actually executes the queries (i.e. the INSERT query)
			$em->flush();
			
		
			return $this->redirectToRoute('kundenliste');
		}
		
		return $this->render('default/new.html.twig', array(
				'form' => $form->createView(),
		));
	}
}