<?php
// src/Pmf/GameInterfaceBundle/Entity/Country.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\PlayableCountryRepository")
 * @ORM\Table(name="playable_countries")
 * 
 */
class PlayableCountry
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
    protected $name;
    
    /**
     * @ORM\Column(type="string", length="10")
     */
    protected $abv;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\Continent", inversedBy="pCountries")
     */
    protected $continent;

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
     * Set abv
     *
     * @param string $abv
     */
    public function setAbv($abv)
    {
        $this->abv = $abv;
    }

    /**
     * Get abv
     *
     * @return string 
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * Set continent
     *
     * @param Pmf\GameInterfaceBundle\Entity\Continent $continent
     */
    public function setContinent(\Pmf\GameInterfaceBundle\Entity\Continent $continent)
    {
        $this->continent = $continent;
    }

    /**
     * Get continent
     *
     * @return Pmf\GameInterfaceBundle\Entity\Continent 
     */
    public function getContinent()
    {
        return $this->continent;
    }
}