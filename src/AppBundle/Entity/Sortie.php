<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sortie
 *
 * @ORM\Table(name="sortie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SortieRepository")
 */
class Sortie
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="nomSortie", type="string", length=30)
     */
    private $nomSortie;

    /**
     * @var \DateTime
     * @Assert\GreaterThanOrEqual(
     *     "today",
     *     message="La sortie ne peut commencer avant la date du jour."
     * )
     * @ORM\Column(name="dateDebutSortie", type="datetime")
     */
    private $dateDebutSortie;

    /**
     * @var int
     * @Assert\Range(
     *     min="5",
     *     max="4320",
     *     minMessage="La durée doit être au minimum de {{ limit }} minutes.",
     *     maxMessage="La durée doit être au maximum de {{ limit }} minutes, soit 3 jours."
     * )
     * @ORM\Column(name="dureeSortie", type="integer", nullable=true)
     */
    private $dureeSortie;

    /**
     * @var \DateTime
     * @Assert\GreaterThan(
     *     "today",
     *     message="La date de clotûre doit être supérieur à la date du jour"
     * )
     *
     * @ORM\Column(name="dateCloture", type="datetime")
     */
    private $dateCloture;

    /**
     * @var int
     * @Assert\Range(
     *     min=1,
     *     max=100,
     *     minMessage="Le nombre d'inscription doit être au minimum de {{ limit }} personne.",
     *     maxMessage="Le nombre doit être au maximum de {{ limit }} personnes."
     * )
     * @ORM\Column(name="nbInscriptionMax", type="integer")
     */
    private $nbInscriptionMax;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="infoSortie", type="text", nullable=true)
     */
    private $infoSortie;

    /**
     * @var string
     *
     * @ORM\Column(name="urlPhoto", type="string", length=255, nullable=true)
     */
    private $urlPhoto;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etat",inversedBy="sortie")
     * */
    private $etat;

    /**
     * @var
<<<<<<< HEAD
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lieu", inversedBy="sortie", cascade={"persist"})
=======
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lieu", inversedBy="sortie", cascade="persist")
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
     */
    private $lieu;


    /**
     * @var
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Site", inversedBy="sortie", cascade={"persist"})
     */
    private $site;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Participant", inversedBy="sortie")
     */
    private $participant;

    /**
     * @var Participant[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Participant")
     */
    private $participants;

    /**
     * Sortie constructor.
     */
    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     * @return Sortie
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }

    /**
     * Set nomSortie
     *
     * @param string $nomSortie
     *
     * @return Sortie
     */
    public function setNomSortie($nomSortie)
    {
        $this->nomSortie = $nomSortie;

        return $this;
    }

    /**
     * Get nomSortie
     *
     * @return string
     */
    public function getNomSortie()
    {
        return $this->nomSortie;
    }

    /**
     * Set dateDebutSortie
     *
     * @param \DateTime $dateDebutSortie
     *
     * @return Sortie
     */
    public function setDateDebutSortie($dateDebutSortie)
    {
        $this->dateDebutSortie = $dateDebutSortie;

        return $this;
    }

    /**
     * Get dateDebutSortie
     *
     * @return \DateTime
     */
    public function getDateDebutSortie()
    {
        return $this->dateDebutSortie;
    }

    /**
     * Set dureeSortie
     *
     * @param integer $dureeSortie
     *
     * @return Sortie
     */
    public function setDureeSortie($dureeSortie)
    {
        $this->dureeSortie = $dureeSortie;

        return $this;
    }

    /**
     * Get dureeSortie
     *
     * @return int
     */
    public function getDureeSortie()
    {
        return $this->dureeSortie;
    }

    /**
     * Set dateCloture
     *
     * @param \DateTime $dateCloture
     *
     * @return Sortie
     */
    public function setDateCloture($dateCloture)
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    /**
     * Get dateCloture
     *
     * @return \DateTime
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * Set nbInscriptionMax
     *
     * @param integer $nbInscriptionMax
     *
     * @return Sortie
     */
    public function setNbInscriptionMax($nbInscriptionMax)
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    /**
     * Get nbInscriptionMax
     *
     * @return int
     */
    public function getNbInscriptionMax()
    {
        return $this->nbInscriptionMax;
    }

    /**
     * Set infoSortie
     *
     * @param string $infoSortie
     *
     * @return Sortie
     */
    public function setInfoSortie($infoSortie)
    {
        $this->infoSortie = $infoSortie;

        return $this;
    }

    /**
     * Get infoSortie
     *
     * @return string
     */
    public function getInfoSortie()
    {
        return $this->infoSortie;
    }


    /**
     * Set urlPhoto
     *
     * @param string $urlPhoto
     *
     * @return Sortie
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    /**
     * Get urlPhoto
     *
     * @return string
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

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
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     * @return Sortie
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     * @return Sortie
     */
    public function setSite($site)
    {
        $this->site = $site;
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
     * @return Sortie
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
    }

    /**
     * @param mixed $participant
     */
    public function removeParticipant($participant)
    {
        //$this->participants->contains($currentUser)

        $this->participants->removeElement($participant);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nomSortie;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param Participant $participant
     * @return $this
     */
    public function addParticipant(Participant $participant)
    {
        $this->participants->add($participant);
        return $this;
    }

}
