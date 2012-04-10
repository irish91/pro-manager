<?php

namespace Pmf\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('PmfStaticBundle:Default:index.html.twig');
    }
}
