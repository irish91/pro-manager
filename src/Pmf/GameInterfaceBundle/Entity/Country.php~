<?php
// src/Pmf/GameInterfaceBundle/Entity/Country.php

namespace Pmf\GameInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pmf\GameInterfaceBundle\Entity\Repository\CountryRepository")
 * @ORM\Table(name="countries")
 * 
 */
class Country
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
     * @ORM\Column(type="string", length="10", nullable=true)
     */
    protected $abv;
    
    /**
     * @ORM\OneToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\Country", mappedBy="country")
     */
    protected $nTeam;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pmf\GameInterfaceBundle\Entity\Continent", inversedBy="countries")
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
     * Set nTeam
     *
     * @param Pmf\GameInterfaceBundle\Entity\Country $nTeam
     */
    public function setNTeam(\Pmf\GameInterfaceBundle\Entity\Country $nTeam)
    {
        $this->nTeam = $nTeam;
    }

    /**
     * Get nTeam
     *
     * @return Pmf\GameInterfaceBundle\Entity\Country 
     */
    public function getNTeam()
    {
        return $this->nTeam;
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