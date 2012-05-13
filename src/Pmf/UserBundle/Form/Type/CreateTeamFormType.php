<?php
// src/Pmf/UserBundle/Form/Type/CreateTeamFormType.php

namespace Pmf\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * - to do: translate labels and messages 
 * 
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 */
class CreateTeamFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text', array(
        	'label' => 'Nom d\'équipe'		
        ));
        
        $builder->add('ABV', 'text', array(
        		'label' => 'ABV'
        ));
        
        $builder->add('gender', 'choice', array(
        		'label' => 'Genre d\'équipe',
        		'choices'   => array(
        				'm' 	=> 'M',
        				'f' 	=> 'F',
        				'both' 	=> 'M/F',
        		),
        		//'expanded' => 'true',
        ));
        
        $builder->add('style', 'choice', array(
        		'label' => 'Style d\'équipe',
        		'choices'   => array(
        				'offensive' 	=> 'Offensive',
        				'neutral' 		=> 'Neutre',
        				'defensive' 	=> 'Défensive',
        		),
        		//'expanded' => 'true',
        ));
         
    }
	
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Pmf\UserBundle\Entity\Team',
    	);
    }
    
    public function getName()
    {
        return 'pmf_user_create_team';
    }
    
}