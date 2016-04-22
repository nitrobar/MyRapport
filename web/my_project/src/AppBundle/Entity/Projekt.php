<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projekt
 *
 * @ORM\Table(name="projekt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjektRepository")
 */
class Projekt
{
	 /**
	 * @ORM\OneToMany(targetEntity="Stundeneintrag", mappedBy="stundeneintrag")
	 */
	private $studneneintraege;
	
	
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
     * @ORM\Column(name="projektname", type="string", length=255)
     */
    private $projektname;


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
     * Set projektname
     *
     * @param string $projektname
     *
     * @return Projekt
     */
    public function setProjektname($projektname)
    {
        $this->projektname = $projektname;

        return $this;
    }

    /**
     * Get projektname
     *
     * @return string
     */
    public function getProjektname()
    {
        return $this->projektname;
    }

    /**
     * Set kundenliste
     *
     * @param \AppBundle\Entity\Kundenliste $kundenliste
     *
     * @return Projekt
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->studneneintraege = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add studneneintraege
     *
     * @param \AppBundle\Entity\Stundeneintrag $studneneintraege
     *
     * @return Projekt
     */
    public function addStudneneintraege(\AppBundle\Entity\Stundeneintrag $studneneintraege)
    {
        $this->studneneintraege[] = $studneneintraege;

        return $this;
    }

    /**
     * Remove studneneintraege
     *
     * @param \AppBundle\Entity\Stundeneintrag $studneneintraege
     */
    public function removeStudneneintraege(\AppBundle\Entity\Stundeneintrag $studneneintraege)
    {
        $this->studneneintraege->removeElement($studneneintraege);
    }

    /**
     * Get studneneintraege
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudneneintraege()
    {
        return $this->studneneintraege;
    }
}
