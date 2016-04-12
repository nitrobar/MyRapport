<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kunde
 *
 * @ORM\Table(name="kunde")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KundeRepository")
 */
class Kunde
{
	
	/**
	 * @ORM\ManyToOne(targetEntity="Kundenliste", inversedBy="kunden")
	 */
	private $kundenliste;
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ort", type="string", length=255)
     */
    private $ort;

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=255)
     */
    private $telefon;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Kunde
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ort
     *
     * @param string $ort
     *
     * @return Kunde
     */
    public function setOrt($ort)
    {
        $this->ort = $ort;

        return $this;
    }

    /**
     * Get ort
     *
     * @return string
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * Set telefon
     *
     * @param string $telefon
     *
     * @return Kunde
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set kundenliste
     *
     * @param \AppBundle\Entity\Kundenliste $kundenliste
     *
     * @return Kunde
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
