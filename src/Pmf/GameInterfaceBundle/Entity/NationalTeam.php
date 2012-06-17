<?php
// src/Pmf/GameInterfaceBundle/Entity/NationalTeam.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\NationalTeamRepository")
 * @ORM\Table(name="national_teams")
 * 
 */
class NationalTeam
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\Country", inversedBy="nTeam")
     */
    protected $country;


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
     * Set country
     *
     * @param Pmf\GameInterfaceBundle\Entity\Country $country
     */
    public function setCountry(\Pmf\GameInterfaceBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return Pmf\GameInterfaceBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}