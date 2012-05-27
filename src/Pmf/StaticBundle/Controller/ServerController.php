<?php

namespace Pmf\StaticBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * -- This is a test commit using Github GUI for windows --
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 */
class ServerController extends Controller
{
    
	/**
	 * Renders static pages
	 */
    public function indexAction($page)
    {	
        // get template
        $template = sprintf("PmfStaticBundle:Page:%s.html.twig", $page);
        

        // check if template exists
        if(!$this->get('templating')->exists($template))

        	throw new NotFoundHttpException("The specified page does not exist.");

        // render current view
        return $this->render($template);
    }
    
    /**
     * renders home page
     */
    public function homepageAction(){
    	
    	// generate token for login_check
    	$csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
    	
    	// render home page
    	return $this->render('PmfStaticBundle:Page:home.html.twig', array(
    		'csrf_token' => $csrfToken,
    	));
    }
}


