<?php

namespace Pmf\StaticBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
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
    	
    	return $this->render('PmfStaticBundle:Page:home.html.twig');
    }
}


