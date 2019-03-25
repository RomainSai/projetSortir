<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SiteRepository")
 */
class Site
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
     * @ORM\Column(name="nomSite", type="string", length=30)
     */
    private $nomSite;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sortie", mappedBy="site")
     */
    private $sortie;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Participant", mappedBy="site")
     */
    private $participant;

    /**
     * Set nomSite
     *
     * @param string $nomSite
     *
     * @return Site
     */
    public function setNomSite($nomSite)
    {
        $this->nomSite = $nomSite;

        return $this;
    }

    /**
     * Get nomSite
     *
     * @return string
     */
    public function getNomSite()
    {
        return $this->nomSite;
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
     * @return Site
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     * @return Site
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
    }

    public function __toString()
    {
    return $this->nomSite;
    }


}

