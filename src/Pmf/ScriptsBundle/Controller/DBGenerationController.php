<?php

namespace Pmf\ScriptsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pmf\GameInterfaceBundle\Entity\Country;
use Pmf\GameInterfaceBundle\Entity\NationalTeam;

/**
 * 
 * @author Tobias Hourst <tobiashourst@gmail.com>
 *
 */
class DBGenerationController extends Controller
{
    
	/**
	 * Generates 'countries' table from flags files
	 * 
	 * - flags files are sorted by continents
	 * 		- each in a folder
	 * 		- folder name is the continent ID
	 */
    public function countriesAction()
    {
    	
    	// path to flags directory
    	$flagsFolderPath = 'assets/common/images/icons/flags/';
    	
    	// number of continents
    	$nbContinents = 6;
    	
    	// response
    	$response = false;
    	
    	// if submitting
    	if($this->container->get('request')->getMethod() == 'POST'){
	    	
	    	// loop through all continents
	    	for($id = 1; $id <= $nbContinents; $id++){
	    		
	    		// current continent folder path
	    		$continentFolderPath = $flagsFolderPath . $id;
	    		
	    		// open directory
	    		$handle = opendir($continentFolderPath);
	    		
	    		// loop through directory
	    		while (false !== ($countryName = readdir($handle))) {
	    			
	    			// no dots
	    			if ($countryName != "." && $countryName != "..") {
	    			
		    			// remove extension (.png)
		    			$countryName = $file = substr($countryName, 0,strrpos($countryName,'.'));
		    			
		    			// uppercase each word
		    			$countryName = ucwords(strtolower($countryName));
		    			
		    			// get entity manager
		    			$em = $this->getDoctrine()->getEntityManager();
		    			
		    			// get continent repository
		    			$continentRepo = $em->getRepository('PmfGameInterfaceBundle:Continent');
		    			
		    			// find continent by ID
		    			$continent = $continentRepo->findOneById($id);
		    			
		    			// instantiate country;
		    			$country = new Country();
		    			
		    			// set country name
		    			$country->setName($countryName);
		    			
		    			// set continent
		    			$country->setContinent($continent);
		    			
		    			//instantiate national team
		    			$nationalTeam = new NationalTeam();
		    			
		    			$nationalTeam->setCountry($country);
		    			
		    			// persist entities
		    			$em->persist($country);
		    			$em->persist($nationalTeam);
	    				
		    			$em->flush();
		    			
		    			// response
		    			$response = true;
	    			}
	    		}	
	    	}
    	}
    	
        return $this->render('PmfScriptsBundle:DBGeneration:countries.html.twig', array(
       		'response' => $response,
        ));
    }
}
