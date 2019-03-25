<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="nomVille", type="string", length=30)
     */
    private $nomVille;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostalVille", type="string", length=10)
     */
    private $codePostalVille;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lieu", mappedBy="ville")
     */
    private $lieu;


    /**
     * Set nomVille
     *
     * @param string $nomVille
     *
     * @return Ville
     */
    public function setNomVille($nomVille)
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * Get nomVille
     *
     * @return string
     */
    public function getNomVille()
    {
        return $this->nomVille;
    }

    /**
     * Set codePostalVille
     *
     * @param string $codePostalVille
     *
     * @return Ville
     */
    public function setCodePostalVille($codePostalVille)
    {
        $this->codePostalVille = $codePostalVille;

        return $this;
    }

    /**
     * Get codePostalVille
     *
     * @return string
     */
    public function getCodePostalVille()
    {
        return $this->codePostalVille;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     * @return Ville
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nomVille;
    }


}

