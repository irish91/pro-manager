<?php

namespace Pmf\UserBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 */
class RegistrationController extends Controller
{
    
	public function createTeamAction(){
		
		return $this->render('PmfUserBundle:Registration:create-team.html.twig');
	}
	
}


