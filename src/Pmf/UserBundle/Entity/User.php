<?php
// src/Pmf/UserBundle/Entity/User.php

namespace Pmf\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\UserBundle\Entity\Repository\UserRepository")
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
     * @ORM\Column(type="datetime")
     */
    protected $birthday;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $gender;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $country;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $language;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $philosophy;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $newsletter = false;
    
    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $facebookID;
    
    /**
     * @ORM\OneToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\Team", mappedBy="user", cascade={"all"});
     */
    protected $team;
    
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

    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set philosophy
     *
     * @param string $philosophy
     */
    public function setPhilosophy($philosophy)
    {
        $this->philosophy = $philosophy;
    }

    /**
     * Get philosophy
     *
     * @return string 
     */
    public function getPhilosophy()
    {
        return $this->philosophy;
    }

    /**
     * Set birthday
     *
     * @param datetime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday
     *
     * @return datetime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set team
     *
     * @param Pmf\UserBundle\Entity\Team $team
     */
    public function setTeam(\Pmf\UserBundle\Entity\Team $team)
    {
        $this->team = $team;
    }

    /**
     * Get team
     *
     * @return Pmf\UserBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get newsletter
     *
     * @return boolean 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }
}