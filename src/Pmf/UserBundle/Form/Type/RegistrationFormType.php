<?php
// src/Pmf/UserBundle/Form/Type/RegistrationFormType.php

namespace Pmf\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * - to do: translate labels and messages 
 * 
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 */
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('username', 'text', array(
        	'label' => 'Pseudo'		
        ));
        
        $builder->add('lastname', 'text', array(
        		'label' => 'Nom'
        ));
        
        $builder->add('firstname', 'text', array(
        		'label' => 'Prénom'
        ));
        
        $builder->add('email', 'email', array(
        		'label' => 'Email'
        ));
        
        $builder->add('plainPassword', 'repeated', array(
        		'type' => 'password',
			    'invalid_message' => 'The password fields must match.',
			    'options' => array('label' => 'Mot de Passe'),
        ));
        
        $builder->add('gender', 'choice', array(
    		'choices'   => array('male' => 'Homme', 'female' => 'Femme'),
        	'label'		=> 'Genre',
    		'required'  => true,
		));
        
        $builder->add('birthday', 'birthday', array(
        		//'widget' => 'single_text',
        		'label' => 'Date de naissance',
        		'format' => 'dd-MM-yyyy',
        ));
        
        $builder->add('country', 'country', array(
        		'label' => 'Pays',
        ));
        
        $builder->add('language', 'choice', array(
        		'choices'   => array('fr' => 'Français', 'en' => 'Anglais'),
        		'label' => 'Langue'
        ));
        
        $builder->add('philosophy', 'choice', array(
        		'choices'   => array(
        								'offensive' 	=> 'Offensive', 
        								'neutral' 		=> 'Neutre',
        								'defensive' 	=> 'Défensive',
        								'pressure'	 	=> 'Préssion',
        								'total-football'=> 'Total Football',
        								'counterattack'	 => 'Contre-Attaque',
         							),
        		'label' => 'Philosophie'
        ));
        
        
    }

    public function getName()
    {
        return 'pmf_user_registration';
    }
    
}