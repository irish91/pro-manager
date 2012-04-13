<?php
// src/Pmf/UserBundle/Entity/User.php

namespace Pmf\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $facebookID;
    
    public function serialize()
    {
    	return serialize(array($this->facebookID, parent::serialize()));
    }
    
    public function unserialize($data)
    {
    	list($this->facebookID, $parentData) = unserialize($data);
    	parent::unserialize($parentData);
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
    }

    /**
     * Get facebookID
     *
     * @return string 
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }
    
    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
    	if (isset($fbdata['id'])) {
    		$this->setFacebookID($fbdata['id']);
    		$this->addRole('ROLE_FACEBOOK');
    	}
    	if (isset($fbdata['first_name'])) {
    		$this->setFirstname($fbdata['first_name']);
    	}
    	if (isset($fbdata['last_name'])) {
    		$this->setLastname($fbdata['last_name']);
    	}
    	if (isset($fbdata['email'])) {
    		$this->setEmail($fbdata['email']);
    	}
    }
    
}