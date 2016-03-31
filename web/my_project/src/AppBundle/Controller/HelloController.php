<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller{
	/**
	 * @Route("/hello", name="helloSite")
	 */
	
	public function indexAction() {
		$name = "Max";
		
		return new Response ( '
        		<html>
				<head>
					<script>
				function myFunction(){
					alert("Hello!");
				}
				</script>
				</head>
        			<body> 	Hello ' . $name . '! 
        					<p><button onclick="myFunction();">Click</button></p>
        			</body>
        		</html>' );
	}
	
}
