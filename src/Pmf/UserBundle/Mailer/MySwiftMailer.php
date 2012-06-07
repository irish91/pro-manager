<?php
namespace Pmf\UserBundle\Mailer;



use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Mailer\TwigSwiftMailer;

class MySwiftMailer extends TwigSwiftMailer
{
    private $container;

    /**
     * @param Symfony\Component\DependencyInjection\ContainerInerface   $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function sendConfirmationEmailMessage(UserInterface $user)
    {
    	$request = $this->container->get('request');
    	
        $template = $this->parameters['template']['confirmation'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'container' => $this->container,
            'session' => $this->container->get('request')->getSession(),
        	'base_path' => $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(),
            'confirmationUrl' => $url
        );

        $this->sendMessage($template, $context, $this->parameters['from_email']['confirmation'], $user->getEmail());
    }

}