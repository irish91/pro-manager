<?php
// src/Pmf/GameInterfaceBundle/Entity/Continent.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\ContinentRepository")
 * @ORM\Table(name="continents")
 * 
 */
class Continent
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
     * @ORM\OneToMany(targetEntity="Pmf\GameInterfaceBundle\Entity\PlayableCountry", mappedBy="continent")
     */
    protected $pCountries;
    
    /**
     * @ORM\OneToMany(targetEntity="Pmf\GameInterfaceBundle\Entity\Country", mappedBy="continent")
     */
    protected $countries;

    public function __construct()
    {
        $this->pCountries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add pCountries
     *
     * @param Pmf\GameInterfaceBundle\Entity\PlayableCountry $pCountries
     */
    public function addPlayableCountry(\Pmf\GameInterfaceBundle\Entity\PlayableCountry $pCountries)
    {
        $this->pCountries[] = $pCountries;
    }

    /**
     * Get pCountries
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPCountries()
    {
        return $this->pCountries;
    }

    /**
     * Add countries
     *
     * @param Pmf\GameInterfaceBundle\Entity\Country $countries
     */
    public function addCountry(\Pmf\GameInterfaceBundle\Entity\Country $countries)
    {
        $this->countries[] = $countries;
    }

    /**
     * Get countries
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }
}