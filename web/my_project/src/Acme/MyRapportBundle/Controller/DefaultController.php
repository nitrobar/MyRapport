<?php

namespace Acme\MyRapportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeMyRapportBundle:Default:index.html.twig');
    }
}
