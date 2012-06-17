<?php
// src/Pmf/GameInterfaceBundle/Entity/League.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\LeagueRepository")
 * @ORM\Table(name="leagues")
 * 
 * @UniqueEntity(fields="name")
 * @UniqueEntity(fields="federation")
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="255", unique=true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="integer", unique=true)
     */
    protected $federation;
    
    /**
     * @ORM\OneToMany(targetEntity="Pmf\GameInterfaceBundle\Entity\Team", mappedBy="league")
     */
    protected $teams;


    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set federation
     *
     * @param integer $federation
     */
    public function setFederation($federation)
    {
        $this->federation = $federation;
    }

    /**
     * Get federation
     *
     * @return integer 
     */
    public function getFederation()
    {
        return $this->federation;
    }

    /**
     * Add teams
     *
     * @param Pmf\GameInterfaceBundle\Entity\Team $teams
     */
    public function addTeam(\Pmf\GameInterfaceBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
    }

    /**
     * Get teams
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}