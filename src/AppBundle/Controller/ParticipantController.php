<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Participant;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
<<<<<<< HEAD
use Symfony\Component\Filesystem\Filesystem;
=======
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Intervention\Image\ImageManager;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Participant controller.
 *
 * @Route("/participant")
 */
class ParticipantController extends Controller
{
    /**
     * Lists all participant entities.
     *
     * @Route("/", name="participant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $participants = $em->getRepository('AppBundle:Participant')->findAll();
        return $this->render('participant/index.html.twig', array(
            'participants' => $participants,
        ));
    }

    /**
     * Crée un nouveu participant. Correspond à la page "MON PROFIL"
     * Les champs (ACTIF, ADMINISTRATEUR, ROLES) sont envoyés dans la BDD avec des valeurs par défault
     *
     * @Route("/inscription", name="participant_inscription")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function InscriptionAction(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        if (!$this->getUser() or $this->isGranted('ROLE_ADMIN')){
            $participant = new Participant();

            $participant->setAdministrateur(0);
            $participant->setActif(1);

            $formInscription = $this->createForm('AppBundle\Form\ParticipantType', $participant);

            $formInscription->remove('administrateur');
            $formInscription->remove('actif');

            $formInscription->handleRequest($request);

            if ($formInscription->isValid() && $formInscription->isSubmitted()) {
                $participant->setRoles(['ROLE_USER']);
                $participant->setSalt('IlPleutIlMouille');
                $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
                $participant->setMotDePasseParticipant($passwordSale);

<<<<<<< HEAD
=======
        if ($formInscription->isValid() && $formInscription->isSubmitted()) {
            $participant->setRoles(['ROLE_USER']);
            $participant->setSalt('IlPleutIlMouille');
            $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
            $participant->setMotDePasseParticipant($passwordSale);

            if ($participant->getPathImage() == null) {
                $participant->setPathImage($this->get('kernel')->getProjectDir() . "\web\images\photoProfil\Avatar_vide.png");
            } else {
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
                //Traitement de l'image
                /**
                 * @var UploadedFile $uploadedFile
                 */

                if($uploadedFile = $participant->getPathImage()){

                    //upload image
                    $imageManager = new ImageManager();

<<<<<<< HEAD
                    $imageOrigine = $imageManager->make($uploadedFile);
                    $imageOrigine->resize(120, 150);

                    $slugify = new Slugify();
                    $filename = $slugify->slugify($participant->getPseudo()) . "-" . $participant->getId() . ".jpg";

                    $imageOrigine->save($this->get('kernel')->getProjectDir()."\web\images\photoProfil\\".$filename);
                    $participant->setPathImage('/images/photoProfil/' . $filename);
                }
                else
                {
                    // image par default
                    $participant->setPathImage('/images/photoAvatar/avatar.jpg');//NE PAS METTRE "WEB" DANS LE CHEMIN D'ACCES!
                }
                $em->persist($participant);
                $em->flush();
=======
                $imageOrigine->save($this->get('kernel')->getProjectDir() . "\web\images\photoProfil\\" . $filename);
                $participant->setPathImage('/images/photoProfil/' . $filename);
            }

            $em->persist($participant);
            $em->flush();
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9

                $this->addFlash('success', 'Le participant a bien été enregistré');
                return $this->redirectToRoute('homepage');
        }

        return $this->render('participant/inscription.html.twig', array(
            'participant' => $participant,
            'form' => $formInscription->createView(),
        ));

        } else{
            $this->addFlash('error', 'Création de compte impossible si vous êtes connecté !');
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * Finds and displays a participant entity.
     *
     * @Route("/{id}", name="participant_afficherProfil")
     * @Method("GET")
     */
    public function afficherProfilAction(Participant $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);

        return $this->render('participant/afficherProfil.html.twig', array(
            'participant' => $participant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * EDITER LE PROFIL D'UN PARTICIPANT
     * @Route("/edit/{id}", name="participant_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Participant $participant
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Participant $participant, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser() == $participant or $this->isGranted("ROLE_ADMIN")) {
            $deleteForm = $this->createDeleteForm($participant);
<<<<<<< HEAD
            $editForm = $this->createForm('AppBundle\Form\ParticipantType', $participant);
            $motDePasse = $participant->getMotDePasseParticipant();

=======

            $editForm = $this->createForm('AppBundle\Form\ParticipantType', $participant);
            $motDePasse = $participant->getMotDePasseParticipant();
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
            $oldPhotoProfile = $participant->getPathImage();
            $editForm->remove('motDePasseParticipant');
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
<<<<<<< HEAD
                $participant->setMotDePasseParticipant($motDePasse);
//                    $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
//                    $participant->setMotDePasseParticipant($passwordSale);
=======


                $participant->setMotDePasseParticipant($motDePasse);

//                    $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
//                    $participant->setMotDePasseParticipant($passwordSale);

>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9

                //Traitement de l'image
                /**
                 * @var UploadedFile $image
                 */
                if ($participant->getPathImage() == null) {
<<<<<<< HEAD
=======

>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
                    $participant->setPathImage($oldPhotoProfile);
                } else {
                    //Traitement de l'image
                    /**
                     * @var UploadedFile $image
                     */
                    $slugify = new Slugify();
                    $filename = $slugify->slugify($participant->getPseudo()) . "-" . $participant->getId() . ".jpg";
<<<<<<< HEAD
                    $image = $participant->getPathImage();
                    $imageManager = new ImageManager();
                    $imageOrigine = $imageManager->make($image);
                    $imageOrigine->resize(120, 150);
                    $imageOrigine->save($this->get('kernel')->getProjectDir() . "\web\images\photoProfil\\" . $filename);
                    $participant->setPathImage('/images/photoProfil/' . $filename);
                }
=======

                    $image = $participant->getPathImage();

                    $imageManager = new ImageManager();
                    $imageOrigine = $imageManager->make($image);
                    $imageOrigine->resize(120, 150);

                    $imageOrigine->save($this->get('kernel')->getProjectDir() . "\web\images\photoProfil\\" . $filename);
                    $participant->setPathImage('/images/photoProfil/' . $filename);
                }

>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
                $em->persist($participant);
                $em->flush();
                $this->addFlash('success', 'Le participant a bien été modifié');
<<<<<<< HEAD
=======

>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
                return $this->redirectToRoute('participant_afficherProfil', array('id' => $participant->getId()));
            }
            return $this->render('participant/edit.html.twig', array(
                'participant' => $participant,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            $this->addFlash('error', 'La modification d\'un utilisateur autre que vous-même est IMPOSSIBLE');
            return $this->redirectToRoute('homepage');
        }
    }
<<<<<<< HEAD

    /**
     * @param Request $request
     * @param Participant $participant
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @Route("/edit/{id}/password", name="participant_edit_password")
     */
    public function editPasswordAction(Request $request, Participant $participant, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser() == $participant or $this->isGranted("ROLE_ADMIN")) {
            $formBuilder = $this->createFormBuilder();
            $formBuilder->add('motDePasseActuel', PasswordType::class, [
                'label' => 'Ancien mot de passe'])
                ->add('motDePasseParticipant', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Le mot de passe doit être identique',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Nouveau Mot de passe',
                        'constraints' => new Length(['min' => 5]),
                        'invalid_message'=> 'Le mot de passe doit contenir minimum  5 caractères et/ou chiffres'],
                    'second_options' => ['label' => 'Confirmation nouveau mot de passe',
                        'constraints' => new Length(['min' => 5]),],
                ])
                ->add('Enregistrer', SubmitType::class);
            $form = $formBuilder->getForm();
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //salage du mot de passe saisi pour savoir si il correspond a celui en base de donnee
                $passwordSaisi = $form->get('motDePasseActuel')->getData();
                $encoderService = $this->container->get('security.password_encoder');
                $match = $encoderService->isPasswordValid($participant, $passwordSaisi);
                if ($match) {
                    $participant->setSalt('IlPleutIlMouille');
                    $passwordSale = $passwordEncoder->encodePassword($participant, $form->get('motDePasseParticipant')->getData());
                    $participant->setMotDePasseParticipant($passwordSale);
                    $em->persist($participant);
                    $em->flush();
                    $this->addFlash('success', 'Votre mot de passe a bien été modifié !');
                    return $this->redirectToRoute('participant_afficherProfil', array('id' => $participant->getId()));
                } else {
                    $this->addFlash('error', 'L\'ancien mot de passe saisi est incorrecte');
                    return $this->redirectToRoute('participant_edit_password', array('id' => $participant->getId()));
                }
            }
=======

    /**
     * @param Request $request
     * @param Participant $participant
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @Route("/edit/{id}/password", name="participant_edit_password")
     */
    public function editPasswordAction(Request $request, Participant $participant, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser() == $participant or $this->isGranted("ROLE_ADMIN")) {
            $formBuilder = $this->createFormBuilder();
            $formBuilder->add('motDePasseActuel', PasswordType::class, [
                'label' => 'Ancien mot de passe'])
                ->add('motDePasseParticipant', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Le mot de passe doit être identique',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Nouveau Mot de passe'],
                    'second_options' => ['label' => 'Confirmation nouveau mot de passe'],
                ])
                ->add('Enregistrer', SubmitType::class);
            $form = $formBuilder->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //salage du mot de passe saisi pour savoir si il correspond a celui en base de donnee
                $passwordSaisi = $form->get('motDePasseActuel')->getData();
                $encoderService = $this->container->get('security.password_encoder');
                $match = $encoderService->isPasswordValid($participant, $passwordSaisi);

                if ($match) {
                    $participant->setSalt('IlPleutIlMouille');
                    $passwordSale = $passwordEncoder->encodePassword($participant, $form->get('motDePasseParticipant')->getData());
                    $participant->setMotDePasseParticipant($passwordSale);

                    $em->persist($participant);
                    $em->flush();

                    $this->addFlash('success', 'Votre mot de passe a bien été modifié !');

                    return $this->redirectToRoute('participant_afficherProfil', array('id' => $participant->getId()));
                } else {
                    $this->addFlash('error', 'L\'ancien mot de passe saisi est incorrecte');
                    return $this->redirectToRoute('participant_edit_password', array('id' => $participant->getId()));
                }
            }

>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9
            return $this->render('participant/editMotDePasse.html.twig', array(
                'participant' => $participant,
                'form' => $form->createView(),
            ));
<<<<<<< HEAD
        } else {
            $this->addFlash('error', 'La modification d\'un utilisateur autre que vous-même est IMPOSSIBLE');
            return $this->redirectToRoute('homepage');
        }
    }

=======

        } else {
            $this->addFlash('error', 'La modification d\'un utilisateur autre que vous-même est IMPOSSIBLE');
            return $this->redirectToRoute('homepage');
        }

    }
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9


    /**
     * SUPPRIME UN PARTICIPANT
     *
     * CETTE FONCTION SUPPRIMERA LA SORTIE UNIQUEMENT SI LE PARTICIPANT SUPPRIME EST L'ORGANISATEUR  (voir annotations dans
     * Participant Entity, variable $sortie)
     *
     * SI LE PARTICIPANT N'EST PAS L'ORGANISATEUR, LA SORTIE NE SERA PAS SUPPRIME (voir annotations dans
     * Participant Entity, variable $sorties  -avec s-)
     *
     * UTILISATION DU FORMBUILDER -> CREATION de BOUTON (supprimer le participant) POUR PLUS DE SECURITE
     * @Route("/delete/{id}", name="participant_delete")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Participant $participant
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function deleteAction(Request $request, Participant $participant, EntityManagerInterface $em)
    {
<<<<<<< HEAD
        if ($this->isGranted("ROLE_ADMIN")) {
            $formBuilder = $this->createFormBuilder();
            $formBuilder->add('Supprimer le participant', SubmitType::class);

            $form = $formBuilder->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $em->remove($participant);
                $em->flush();

                $this->addFlash('success', 'Le participant a bien été supprimé');
                return $this->redirectToRoute('participant_index');
            }
=======
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('Supprimer le participant', SubmitType::class);

        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->remove($participant);
            $em->flush();

            $this->addFlash('success', 'Le participant a bien été supprimé');
            return $this->redirectToRoute('participant_index');
        }

        return $this->render('participant/delete.html.twig', [
            'participants' => $participant,
            'form' => $form->createView()
        ]);
>>>>>>> 4c29eb236ff2811102bd35ac83185bdafb7fb8b9

            return $this->render('participant/delete.html.twig', [
                'participants' => $participant,
                'form' => $form->createView()]);
       }else{
                $this->addFlash('error', 'La suppression d\'un utilisateur autre que l\'administrateur est IMPOSSIBLE');
                return $this->redirectToRoute('homepage');
       }
    }


    /**
     * CREE UN FORM POUR POUVOIR SUPPRIMER UN PARTICIPANT
     * @param Participant $participant
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Participant $participant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participant_delete', array('id' => $participant->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}