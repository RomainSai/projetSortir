<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtatRepository")
 */
class Etat
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=30)
     */
    private $libelle;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sortie", mappedBy="etat")
     */
    private $sortie;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * @param mixed $sortie
     * @return Etat
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
        return $this;
    }


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Etat
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->libelle;
    }


}

