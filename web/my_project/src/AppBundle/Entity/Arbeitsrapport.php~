<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Kundenliste;

/**
 * Arbeitsrapport
 *
 * @ORM\Table(name="arbeitsrapport")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArbeitsrapportRepository")
 */
class Arbeitsrapport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;
    
  	
  	/**
	 * @ORM\ManyToOne(targetEntity="Kundenliste", inversedBy="kunden")
	 */
	private $kundenliste;
	
	//-------------------------------------------neu--------------------------------
	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 */
	private $name;
	//-------------------------------------------neu--------------------------------
	

 	/**
     * Set id
     
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
	
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    
    //-------------------------------------------neu--------------------------------
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Kunde
     */
    public function setName($name)
    {
    	$this->name = $name;
    
    	return $this;
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
    //-------------------------------------------neu--------------------------------
    
    
    
    /**
     * Set kundenliste
     *
     * @param \AppBundle\Entity\Kundenliste $kundenliste
     *
     * @return Arbeitsrapport
     */
    public function setKundenliste(\AppBundle\Entity\Kundenliste $kundenliste = null)
    {
        $this->kundenliste = $kundenliste;

        return $this;
    }

    /**
     * Get kundenliste
     *
     * @return \AppBundle\Entity\Kundenliste
     */
    public function getKundenliste()
    {
        return $this->kundenliste;
    }
}
