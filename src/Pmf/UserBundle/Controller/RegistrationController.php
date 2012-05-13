<?php

namespace Pmf\UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

use Pmf\UserBundle\Form\Type\CreateTeamFormType;
use Pmf\UserBundle\Entity\Team;

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
	
			/*if ($confirmationEnabled) {
				$this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
				$route = 'fos_user_registration_check_email';
			} else {
				$this->authenticateUser($user);
				$route = 'fos_user_registration_confirmed';
			}
	
			$this->setFlash('fos_user_success', 'registration.flash.user_created');*/
			
			if($this->container->get('request')->isXmlHttpRequest()){
				
				$data = array(
						'success' => true,
						'user' => $user,
				);
				
				return new Response(json_encode($data)); 
				
			} else {
				$url = $this->container->get('router')->generate('fos_user_registration_check_email');
				return new RedirectResponse($url);
			}
			
		} else {
			if($this->container->get('request')->isXmlHttpRequest())
				return new Response(json_encode(array('success' => false)));
		}
		
	
		return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
				'form' => $form->createView(),
				'theme' => $this->container->getParameter('fos_user.template.theme'),
		));
	}
	
	public function createTeamAction(){
		
		// get user object and check if user is connected
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException(
					'You need to be connected to access this page.');
		}
		
		$team = new Team();
		
		$form = $this->container->get('form.factory')->create(new CreateTeamFormType(), $team);
		
		if ($this->container->get('request')->getMethod() == 'POST'){
			$form->bindRequest($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				
				$team->setUser();
				
				$em->persist($team);
				$em->flush();
				
				$url = $this->container->get('router')->generate('register_sign_contract');
				return new RedirectResponse($url);
			}
		}
		
		return $this->container->get('templating')->renderResponse('PmfUserBundle:Registration:create-team.html.twig', array(
				'form' => $form->createView(),
		));
	}
	
	public function signContractAction(){
		return $this->container->get('templating')->renderResponse('PmfUserBundle:Registration:sign-contract.html.twig');
	}
	
}


