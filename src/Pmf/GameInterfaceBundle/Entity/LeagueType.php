<?php
// src/Pmf/GameInterfaceBundle/Entity/LeagueType.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\LeagueTypeRepository")
 * @ORM\Table(name="league_types")
 * 
 * @UniqueEntity(fields="name")
 */
class LeagueType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Pmf\GameInterfaceBundle\Entity\League", mappedBy="type")
     */
    protected $leagues;
    
    /**
     * @ORM\Column(type="string", length="255", unique=true)
     */
    protected $name;
    
    public function __construct()
    {
        $this->leagues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add leagues
     *
     * @param Pmf\GameInterfaceBundle\Entity\League $leagues
     */
    public function addLeague(\Pmf\GameInterfaceBundle\Entity\League $leagues)
    {
        $this->leagues[] = $leagues;
    }

    /**
     * Get leagues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLeagues()
    {
        return $this->leagues;
    }
}