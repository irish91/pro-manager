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
use Symfony\Component\DependencyInjection\ContainerInterface;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

use Pmf\UserBundle\Form\Type\CreateTeamFormType;
use Pmf\GameInterfaceBundle\Entity\Team;

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
		
		// redirect user to the game if already connected
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (is_object($user)) {
			return new RedirectResponse($this->container->get('router')->generate('game_desk'));
		}
		
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
				
				return new RedirectResponse(
						$this->container->get('router')->generate('fos_user_registration_check_email')
				);
			}
			
		} else {
			
			if($this->container->get('request')->isXmlHttpRequest()){
				
				$data = array(
					'success' => false,
					'errorsView' => $this->container->get('templating')	
						->render('PmfUserBundle:Registration:ajax-form-errors.html.twig', array(
							'form' => $form->createView(),
						)),	
				);
				
				return new Response(json_encode($data));
				
			}
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
			return new RedirectResponse(
					$this->container->get('router')->generate('fos_user_security_login')
			);
		}
	
		$user->setConfirmationToken(null);
		$user->setEnabled(true);
		$user->setLastLogin(new \DateTime());
	
		$this->container->get('fos_user.user_manager')->updateUser($user);
		$this->authenticateUser($user);
	
		return new RedirectResponse(
				$this->container->get('router')->generate('registration_create_team')
		);
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
		
		// redirect user to "sign contract" page if the team has already been created
		if (is_object($user->getTeam()) && $user->getTeam() != null) {
			return new RedirectResponse(
					$this->container->get('router')->generate('registration_sign_contract')
			);
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
				
				if($this->container->get('request')->isXmlHttpRequest()){
					
					$data = array(
						'success' => true,
					);
					
					return new Response(json_encode($data));
					
				} else {

					return new RedirectResponse(
								$this->container->get('router')->generate('registration_sign_contract')
					);
				}
				
			} else {
				
				if($this->container->get('request')->isXmlHttpRequest()){
				
				$data = array(
					'success' => false,
					'errorsView' => $this->container->get('templating')	
						->render('PmfUserBundle:Registration:ajax-form-errors.html.twig', array(
							'form' => $form->createView(),
						)),	
				);
				
				return new Response(json_encode($data));
				
				}
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
		
		// get user object and check if user is connected
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException(
					'You need to be connected to access this page.');
		}
		
		// redirect user to the game if already connected
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (is_object($user) && $user->hasRole('ROLE_ACTIVE_USER')) {
			return new RedirectResponse($this->container->get('router')->generate('game_desk'));
		}
		
		$form = $this->container->get('form.factory')->createBuilder('form')
			->add('contract', 'choice', array(
    			'choices'   => array(true => ' ', false => ' '),
        		'label'		=> 'REGLEMENT',
    			'required'  => true,
        		'expanded' => true,
			))
			->add('newsletter', 'choice', array(
    			'choices'   => array(true => ' ', false => ' '),
        		'label'		=> 'NEWSLETTER',
    			'required'  => true,
        		'expanded' => true
			))
			->getForm();
		
		if ($this->container->get('request')->getMethod() == 'POST'){
			$form->bindRequest($this->container->get('request'));
			
			$data = $form->getData();
			
			if ($data['contract'] == true){
				
				$em = $this->container->get('doctrine')->getEntityManager();
				
				// activate user (set ACTIVE_ROLE)
				$user->addRole('ROLE_ACTIVE_USER');
				
				if ($data['newsletter'] == true)
					$user->setNewsletter(true);
				
				$em->persist($user);
				$em->flush();
				
				return new RedirectResponse(
					$this->container->get('router')->generate('game_desk')
				);
			}
		}
		
		return $this->container->get('templating')
				->renderResponse('PmfUserBundle:Registration:sign-contract.html.twig', array(
					'form' => $form->createView(),				
		));
	}
	
}