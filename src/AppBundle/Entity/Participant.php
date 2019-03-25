<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Participant
 *@UniqueEntity("pseudo", message="le pseudo existe déjà")
 * @UniqueEntity("mailParticipant", message="l'email existe déjà")
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantRepository")
 */
class Participant implements UserInterface
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
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="20", minMessage="Le pseudo doit contenir au moins {{ limit }} caractères",
     *                 maxMessage="Le pseudo doit contenir au maximum {{ limit }} caractères")
     * @ORM\Column(name="pseudo", type="string", length=20, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="2", minMessage="Le nom doit contenir au moins {{ limit }} caractères")
     * @ORM\Column(name="nomParticipant", type="string", length=255)
     */
    private $nomParticipant;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="2", minMessage="Le nom doit contenir au moins {{ limit }} caractères")
     * @ORM\Column(name="prenomParticipant", type="string", length=255)
     */
    private $prenomParticipant;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="10", max="10")
     * @Assert\Regex(pattern="/[0-9]*$/")
     * @ORM\Column(name="telephoneParticipant", type="string", length=20, nullable=true)
     */
    private $telephoneParticipant;

    /**
     * @var string
     *@Assert\NotBlank()
     * @Assert\Email(message="L'e-mail '{{ value }}' n'est pas un mail valide")
     * @ORM\Column(name="mailParticipant", type="string", length=255)
     */
    private $mailParticipant;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="5", minMessage="Le mot de passe doit contenir au moins {{ limit }} lettres ou chiffres")
     * @ORM\Column(name="motDePasseParticipant", type="string", length=255)
     */
    private $motDePasseParticipant;

    /**
     * @var
     * @Assert\Image(maxSize="2M", allowLandscape=false, maxSizeMessage="la photo ne doit pas dépasser 2Mo")
     * @ORM\Column(name="path_image", type="string", length=255, nullable=true)
     *
     */
    private $pathImage;

    /**
     * @var bool
     *
     * @ORM\Column(name="administrateur", type="boolean")
     */
    private $administrateur;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Site", inversedBy="participant")
     */
    private $site;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sortie", mappedBy="participant")
     */
    private $sortie;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Sortie")
     */
    private $sorties;

    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Participant
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set nomParticipant
     *
     * @param string $nomParticipant
     *
     * @return Participant
     */
    public function setNomParticipant($nomParticipant)
    {
        $this->nomParticipant = $nomParticipant;

        return $this;
    }

    /**
     * Get nomParticipant
     *
     * @return string
     */
    public function getNomParticipant()
    {
        return $this->nomParticipant;
    }

    /**
     * Set prenomParticipant
     *
     * @param string $prenomParticipant
     *
     * @return Participant
     */
    public function setPrenomParticipant($prenomParticipant)
    {
        $this->prenomParticipant = $prenomParticipant;

        return $this;
    }

    /**
     * Get prenomParticipant
     *
     * @return string
     */
    public function getPrenomParticipant()
    {
        return $this->prenomParticipant;
    }

    /**
     * Set telephoneParticipant
     *
     * @param string $telephoneParticipant
     *
     * @return Participant
     */
    public function setTelephoneParticipant($telephoneParticipant)
    {
        $this->telephoneParticipant = $telephoneParticipant;

        return $this;
    }

    /**
     * Get telephoneParticipant
     *
     * @return string
     */
    public function getTelephoneParticipant()
    {
        return $this->telephoneParticipant;
    }

    /**
     * Set mailParticipant
     *
     * @param string $mailParticipant
     *
     * @return Participant
     */
    public function setMailParticipant($mailParticipant)
    {
        $this->mailParticipant = $mailParticipant;

        return $this;
    }

    /**
     * Get mailParticipant
     *
     * @return string
     */
    public function getMailParticipant()
    {
        return $this->mailParticipant;
    }

    /**
     * Set motDePasseParticipant
     *
     * @param string $motDePasseParticipant
     *
     * @return Participant
     */
    public function setMotDePasseParticipant($motDePasseParticipant)
    {
        $this->motDePasseParticipant = $motDePasseParticipant;

        return $this;
    }

    /**
     * Get motDePasseParticipant
     *
     * @return string
     */
    public function getMotDePasseParticipant()
    {
        return $this->motDePasseParticipant;
    }

    /**
     * Set administrateur
     *
     * @param boolean $administrateur
     *
     * @return Participant
     */
    public function setAdministrateur($administrateur)
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * Get administrateur
     *
     * @return bool
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Participant
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return bool
     */
    public function getActif()
    {
        return $this->actif;
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
     * @return Participant
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
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
     * @return Participant
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSorties()
    {
        return $this->sorties;
    }

    /**
     * @param mixed $sorties
     * @return Participant
     */
    public function setSorties($sorties)
    {
        $this->sorties = $sorties;
        return $this;
    }



    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles){
        $this->roles = $roles;
        return $this;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->motDePasseParticipant;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt){
        $this->salt = $salt;
        return $this;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->mailParticipant;
    }

    /**
     * @return mixed
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    /**
     * @param mixed $pathImage
     * @return Participant
     */
    public function setPathImage($pathImage)
    {
        $this->pathImage = $pathImage;
        return $this;
    }



    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return string
     */
    public function __toString()
    {
       return $this->pseudo;
    }


}

