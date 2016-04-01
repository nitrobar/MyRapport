<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class KundenlisteController extends Controller
{
	/**
	 * @Route("kunden", name="kundenliste")
	 */
	
	public function listAction()
	{
		
		
		$repository = $this->getDoctrine()->getRepository('AppBundle:Kundenliste');
		$kunden = $repository->findAll();
		//$kunden = $repository->findOneByName('Fritz Fischer');

		//echo 'Ort von index ' . $id . ':'  . $kunden[$id]->getOrt();

		return $this->render('kunden/kundenTable.html.twig',
				array('kunden' => $kunden)
				);
	}
}