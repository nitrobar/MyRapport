<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mitarbeiterliste
 *
 * @ORM\Table(name="mitarbeiterliste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MitarbeiterlisteRepository")
 */
class Mitarbeiterliste
{
	
	/**
	 * @ORM\OneToMany(targetEntity="Mitarbeiter", mappedBy="mitarbeiterliste")
	 */
	private $mitarbeiter;
	
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
     * @return Mitarbeiterliste
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
     * Constructor
     */
    public function __construct()
    {
        $this->mitarbeiter = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mitarbeiter
     *
     * @param \AppBundle\Entity\Mitarbeiter $mitarbeiter
     *
     * @return Mitarbeiterliste
     */
    public function addMitarbeiter(\AppBundle\Entity\Mitarbeiter $mitarbeiter)
    {
        $this->mitarbeiter[] = $mitarbeiter;

        return $this;
    }

    /**
     * Remove mitarbeiter
     *
     * @param \AppBundle\Entity\Mitarbeiter $mitarbeiter
     */
    public function removeMitarbeiter(\AppBundle\Entity\Mitarbeiter $mitarbeiter)
    {
        $this->mitarbeiter->removeElement($mitarbeiter);
    }

    /**
     * Get mitarbeiter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMitarbeiter()
    {
        return $this->mitarbeiter;
    }
}
