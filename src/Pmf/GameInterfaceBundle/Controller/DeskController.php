<?php

namespace Pmf\GameInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * 
 * @author Tobias Hourst <tobiashourst@gmail.com>
 *
 */
class DeskController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('PmfGameInterfaceBundle:Desk:index.html.twig');
    }
}
