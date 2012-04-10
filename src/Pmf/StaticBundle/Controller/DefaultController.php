<?php

namespace Pmf\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {	
    	
    	$test = "merde";
    	
        return $this->render('PmfStaticBundle:Default:index.html.twig', array(
        	'test' => $test,		
        ));
    }
}
