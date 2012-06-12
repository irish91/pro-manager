<?php

namespace Pmf\GameInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DeskController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('PmfGameInterfaceBundle:Desk:index.html.twig');
    }
}
