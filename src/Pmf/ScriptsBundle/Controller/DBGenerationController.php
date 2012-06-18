<?php

namespace Pmf\ScriptsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DBGenerationController extends Controller
{
    
    public function countriesAction()
    {
        return $this->render('PmfScriptsBundle:DBGeneration:countries.html.twig');
    }
}
