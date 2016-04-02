<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MateriallisteController extends Controller
{
	/**
	 * @Route("material", name="materialliste")
	 */
	
	public function listAction()
	{
		
		
		$repository = $this->getDoctrine()->getRepository('AppBundle:Materialliste');
		$material = $repository->findAll();
		//$kunden = $repository->findOneByName('Fritz Fischer');

		//echo 'Ort von index ' . $id . ':'  . $kunden[$id]->getOrt();

		return $this->render('material/materialTable.html.twig',
				array('material' => $material)
				);
	}
}