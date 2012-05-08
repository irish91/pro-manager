<?php

namespace Pmf\UserBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

/**
 *
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 * 
 * - extends FOSUserBundle RegistrationController
 */
class RegistrationController extends BaseController
{
    /**
     * Ovverides registerAction
     */
	public function registerAction()
	{
		$form = $this->container->get('fos_user.registration.form');
		$formHandler = $this->container->get('fos_user.registration.form.handler');
		$confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
	
		$process = $formHandler->process($confirmationEnabled);
		if ($process) {
			$user = $form->getData();
	
			if ($confirmationEnabled) {
				$this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
				$route = 'fos_user_registration_check_email';
			} else {
				$this->authenticateUser($user);
				$route = 'fos_user_registration_confirmed';
			}
	
			$this->setFlash('fos_user_success', 'registration.flash.user_created');
			$url = $this->container->get('router')->generate($route);
	
			return new RedirectResponse($url);
		}
	
		return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
				'form' => $form->createView(),
				'theme' => $this->container->getParameter('fos_user.template.theme'),
		));
	}
	
	public function createTeamAction(){
		
		return $this->render('PmfUserBundle:Registration:create-team.html.twig');
	}
	
}


