<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mitarbeiter
 *
 * @ORM\Table(name="mitarbeiter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MitarbeiterRepository")
 */
class Mitarbeiter
{
	
	/**
	 * @ORM\ManyToOne(targetEntity="Mitarbeiterliste", inversedBy="mitarbeiter")
	 */
	private $mitarbeiterliste;
	
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
     * @var int
     *
     * @ORM\Column(name="stundenansatz", type="integer")
     */
    private $stundenansatz;

    /**
     * @var string
     *
     * @ORM\Column(name="funktion", type="string", length=255)
     */
    private $funktion;


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
     * @return Mitarbeiter
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
     * Set stundenansatz
     *
     * @param integer $stundenansatz
     *
     * @return Mitarbeiter
     */
    public function setStundenansatz($stundenansatz)
    {
        $this->stundenansatz = $stundenansatz;

        return $this;
    }

    /**
     * Get stundenansatz
     *
     * @return int
     */
    public function getStundenansatz()
    {
        return $this->stundenansatz;
    }

    /**
     * Set funktion
     *
     * @param string $funktion
     *
     * @return Mitarbeiter
     */
    public function setFunktion($funktion)
    {
        $this->funktion = $funktion;

        return $this;
    }

    /**
     * Get funktion
     *
     * @return string
     */
    public function getFunktion()
    {
        return $this->funktion;
    }

    /**
     * Set mitarbeiterliste
     *
     * @param \AppBundle\Entity\Mitarbeiterliste $mitarbeiterliste
     *
     * @return Mitarbeiter
     */
    public function setMitarbeiterliste(\AppBundle\Entity\Mitarbeiterliste $mitarbeiterliste = null)
    {
        $this->mitarbeiterliste = $mitarbeiterliste;

        return $this;
    }

    /**
     * Get mitarbeiterliste
     *
     * @return \AppBundle\Entity\Mitarbeiterliste
     */
    public function getMitarbeiterliste()
    {
        return $this->mitarbeiterliste;
    }
}
