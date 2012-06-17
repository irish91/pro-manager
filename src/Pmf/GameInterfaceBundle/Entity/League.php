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
     * @ORM\ManyToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\LeagueType", inversedBy="leagues")
     */
    protected $type;
    
    /**
     * @ORM\Column(type="integer")
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
     * Set type
     *
     * @param Pmf\GameInterfaceBundle\Entity\LeagueType $type
     */
    public function setType(\Pmf\GameInterfaceBundle\Entity\LeagueType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return Pmf\GameInterfaceBundle\Entity\LeagueType 
     */
    public function getType()
    {
        return $this->type;
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