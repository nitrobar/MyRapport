<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materialliste
 *
 * @ORM\Table(name="materialliste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MateriallisteRepository")
 */
class Materialliste
{	
	/**
	 * @ORM\OneToMany(targetEntity="Material", mappedBy="materialliste")
	 */
	private $materialien;
	
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
     * @ORM\Column(name="Name", type="string", length=255)
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
     * @return Materialliste
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
        $this->materialien = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add materialien
     *
     * @param \AppBundle\Entity\Material $materialien
     *
     * @return Materialliste
     */
    public function addMaterialien(\AppBundle\Entity\Material $materialien)
    {
        $this->materialien[] = $materialien;

        return $this;
    }

    /**
     * Remove materialien
     *
     * @param \AppBundle\Entity\Material $materialien
     */
    public function removeMaterialien(\AppBundle\Entity\Material $materialien)
    {
        $this->materialien->removeElement($materialien);
    }

    /**
     * Get materialien
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaterialien()
    {
        return $this->materialien;
    }
}

