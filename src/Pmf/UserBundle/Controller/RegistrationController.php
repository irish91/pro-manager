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
 * 
 */
class RegistrationController extends BaseController
{
    /**
     * Register
     * --------
     * 
     * 1rst registration page.
     * 
     * A verification email is sent on success.
     * 
     * - Overrides registerAction
     */
	public function registerAction()
	{
		$form = $this->container->get('fos_user.registration.form');
		$formHandler = $this->container->get('fos_user.registration.form.handler');
		$confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
	
		$process = $formHandler->process($confirmationEnabled);
		if ($process) {
			$user = $form->getData();
			
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
				return new Response(json_encode(array('success' => false, 'errors' => $form->getErrors())));
		}
		
		return $this->container->get('templating')
				->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
					'form' => $form->createView(),
					'theme' => $this->container->getParameter('fos_user.template.theme'),
				));
	}
	
	
	/**
	 * Overrides confirmAction
	 * 
	 * - redirects to "create team" page after confirmation
	 */
	public function confirmAction($token)
	{
		$user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
	
		if (null === $user) {
			throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
		}
	
		$user->setConfirmationToken(null);
		$user->setEnabled(true);
		$user->setLastLogin(new \DateTime());
	
		$this->container->get('fos_user.user_manager')->updateUser($user);
		$this->authenticateUser($user);
	
		return new RedirectResponse($this->container->get('router')->generate('registration_create_team'));
	}
	
	/**
	 * Create Team 
	 * -----------
	 * 
	 * 2nd registration page. Only available to registered users 
	 * who have completed the 1rst form.
	 * 
	 * The user is redirected to this page when verifying his email address.
	 * 
	 * - You must be connected to access this page
	 */
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
			$form->bindRequest($this->container->get('request'));
			
			if ($form->isValid()) {
				$em = $this->container->get('doctrine')->getEntityManager();
				
				$team->setUser($user);
				
				$em->persist($team);
				$em->flush();
				
				$url = $this->container->get('router')->generate('registration_sign_contract');
				return new RedirectResponse($url);
			}
		}
		
		return $this->container->get('templating')
				->renderResponse('PmfUserBundle:Registration:create-team.html.twig', array(
						'form' => $form->createView(),
				));
	}
	
	/**
	 * Sign Contract
	 * -------------
	 * 
	 * 3rd registration page.
	 * 
	 * Last step, the user must sign the contract (terms and conditions) 
	 * in order to complete the registration process.
	 */
	public function signContractAction(){
		
		return $this->container->get('templating')
				->renderResponse('PmfUserBundle:Registration:sign-contract.html.twig');
	}
	
}


