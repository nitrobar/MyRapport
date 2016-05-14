<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materialeintrag
 *
 * @ORM\Table(name="materialeintrag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaterialeintragRepository")
 */
class Materialeintrag
{
	
	/**
	 * @ORM\ManyToOne(targetEntity="Materialliste", inversedBy="materialien")
	 */
	private $materialliste;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Materialeintragliste", inversedBy="materialeintrag")
	 */
	private $materialeintragliste;
	
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="anzahl", type="integer")
     */
    private $anzahl;

    /**
     * @var int
     *
     * @ORM\Column(name="betragProAnzahl", type="integer")
     */
    private $betragProAnzahl;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    
    /**
     * @var int
     *
     * @ORM\Column(name="arbeitsrapportId", type="integer")
     */
    private $arbeitsrapportId;
    

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
     * Set anzahl
     *
     * @param integer $anzahl
     *
     * @return Materialeintrag
     */
    public function setAnzahl($anzahl)
    {
        $this->anzahl = $anzahl;

        return $this;
    }

    /**
     * Get anzahl
     *
     * @return int
     */
    public function getAnzahl()
    {
        return $this->anzahl;
    }

    /**
     * Set betragProAnzahl
     *
     * @param integer $betragProAnzahl
     *
     * @return Materialeintrag
     */
    public function setBetragProAnzahl($betragProAnzahl)
    {
        $this->betragProAnzahl = $betragProAnzahl;

        return $this;
    }

    /**
     * Get betragProAnzahl
     *
     * @return int
     */
    public function getBetragProAnzahl()
    {
        return $this->betragProAnzahl;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Materialeintrag
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set materialliste
     *
     * @param \AppBundle\Entity\Materialliste $materialliste
     *
     * @return Materialeintrag
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

    /**
     * Set materialeintragliste
     *
     * @param \AppBundle\Entity\Materialeintragliste $materialeintragliste
     *
     * @return Materialeintrag
     */
    public function setMaterialeintragliste(\AppBundle\Entity\Materialeintragliste $materialeintragliste = null)
    {
        $this->materialeintragliste = $materialeintragliste;

        return $this;
    }

    /**
     * Get materialeintragliste
     *
     * @return \AppBundle\Entity\Materialeintragliste
     */
    public function getMaterialeintragliste()
    {
        return $this->materialeintragliste;
    }

    /**
     * Set arbeitsrapportId
     *
     * @param integer $arbeitsrapportId
     *
     * @return Materialeintrag
     */
    public function setArbeitsrapportId($arbeitsrapportId)
    {
        $this->arbeitsrapportId = $arbeitsrapportId;

        return $this;
    }

    /**
     * Get arbeitsrapportId
     *
     * @return integer
     */
    public function getArbeitsrapportId()
    {
        return $this->arbeitsrapportId;
    }
}
