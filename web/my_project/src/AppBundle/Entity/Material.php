<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Material
 *
 * @ORM\Table(name="material")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaterialRepository")
 */
class Material
{
	/**
	 * @var unknown
	 * @ORM\ManyToOne(targetEntity="Materialliste", inversedBy="materialien")
	 */
	private $materialliste;
	
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
     * @ORM\Column(name="Typ", type="string", length=255)
     */
    private $typ;

    /**
     * @var int
     *
     * @ORM\Column(name="Preis", type="integer")
     */
    private $preis;


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
     * Set typ
     *
     * @param string $typ
     *
     * @return Material
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return string
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set preis
     *
     * @param integer $preis
     *
     * @return Material
     */
    public function setPreis($preis)
    {
        $this->preis = $preis;

        return $this;
    }

    /**
     * Get preis
     *
     * @return int
     */
    public function getPreis()
    {
        return $this->preis;
    }

    /**
     * Set materialliste
     *
     * @param \AppBundle\Entity\Materialliste $materialliste
     *
     * @return Material
     */
    public function setMaterialliste(\AppBundle\Entity\Materialliste $materialliste = null)
    {
        $this->materialliste = $materialliste;

        return $this;
    }

    /**
     * Get materialliste
     *
     * @return \AppBundle\Entity\Materialliste
     */
    public function getMaterialliste()
    {
        return $this->materialliste;
    }
}
