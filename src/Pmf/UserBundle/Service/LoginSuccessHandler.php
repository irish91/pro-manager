<?php
 
namespace Pmf\UserBundle\Service;
 
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
 
/**
 * LoginSuccessHandler.
 * 
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{   
    /**
     * @var Router $router
     */
    protected $router;
 
    /**
     * @var SecurityContext $security
     */
    protected $security;
 
 
    /**
     * Constructs a new instance of SecurityListener.
     * 
     * @param Router $router The router
     * @param SecurityContext $security The security context
     */
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }
 
    /**
     * Invoked after a successful login.
     * 
     * - Redirect user depending on his ROLE.
     * 		- if the user has not complete the whole registration process, he is redirected to the "create team" page.
     * 			- the controller then checks if the team has already been created, if not, redirect the user to "sign contract" page.
     * 		- if the user has an ACTIVE_ROLE, he is then redirected to the game. 
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) 
    {
    	// redirect not active user to create team page
        if ($this->security->isGranted('ROLE_USER')) {

        	$response = new RedirectResponse($this->router->generate('registration_create_team'));

	    }
	    // redirect active user to the game 
	    elseif ($this->security->isGranted('ROLE_ACTIVE_USER')) 
	    { 
	    
	     	// !!THIS IS TEMPORARY!! must redirect to game interface!
	      	$referer_url = $request->headers->get('referer'); 
	             
	      	$response = new RedirectResponse($referer_url); 
	    } 
	    
	    return $response;
	}

}