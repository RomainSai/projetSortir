<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LieuRepository")
 */
class Lieu
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
     * @ORM\Column(name="nomLieu", type="string", length=30)
     *
     */
    private $nomLieu;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=30, nullable=true)
     */
    private $rue;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sortie",mappedBy="lieu")
     */
    private $sortie;

    /**
     * @var
<<<<<<< HEAD
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Ville",inversedBy="lieu", cascade="persist")
     *
=======
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ville",inversedBy="lieu", cascade="persist")
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
     */
    private $ville;


    /**
     * Set nomLieu
     *
     * @param string $nomLieu
     *
     * @return Lieu
     */
    public function setNomLieu($nomLieu)
    {
        $this->nomLieu = $nomLieu;

        return $this;
    }

    /**
     * Get nomLieu
     *
     * @return string
     */
    public function getNomLieu()
    {
        return $this->nomLieu;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Lieu
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Lieu
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Lieu
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
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
     * @return Lieu
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     * @return Lieu
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nomLieu;
    }


}

