<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KundenlisteController extends Controller
{
	/**
	 * @Route("kunden")
	 */
	
	public function listAction()
	{
		
		$repository = $this->getDoctrine()->getRepository('AppBundle:Kundenliste');
		$kunden = $repository->findAll();

		return $this->render('kunden/kundenTable.html.twig',
				array('kunden' => $kunden)
				);
	}
}