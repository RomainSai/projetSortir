<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Participant;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Intervention\Image\ImageManager;

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
        $participant = new Participant();

        $participant->setAdministrateur(0);
        $participant->setActif(1);
        $participant->setPathImage("\web\images\photoProfil\\");

        $formInscription = $this->createForm('AppBundle\Form\ParticipantType', $participant);

        $formInscription->remove('administrateur');
        $formInscription->remove('actif');

        $formInscription->handleRequest($request);

        if ($formInscription->isValid() && $formInscription->isSubmitted()) {
            $participant->setRoles(['ROLE_USER']);
            $participant->setSalt('IlPleutIlMouille');
            $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
            $participant->setMotDePasseParticipant($passwordSale);

            $em->persist($participant);
            $em->flush();

            //Traitement de l'image
            /**
             * @var UploadedFile $image
             */
            $slugify = new Slugify();
            $filename = $slugify->slugify($participant->getPseudo()) . "-" . $participant->getId() . ".jpg";

            $image = $participant->getPathImage();

            $imageManager = new ImageManager();
            $imageOrigine = $imageManager->make($image);
            $imageOrigine->resize(200);

            $imageOrigine->save($this->get('kernel')->getProjectDir()."\web\images\photoProfil\\".$filename);
            $participant->setPathImage('/images/photoProfil/' . $filename);

            $em->persist($participant);
            $em->flush();

            $this->addFlash('success', 'Le participant a bien été enregistré');
            return $this->redirectToRoute('participant_afficherProfil', array('id' => $participant->getId()));
        }

        return $this->render('participant/inscription.html.twig', array(
            'participant' => $participant,
            'form' => $formInscription->createView(),
        ));

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
        $deleteForm= $this->createDeleteForm($participant);

        $editForm= $this->createForm('AppBundle\Form\ParticipantType', $participant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()&&$editForm->isValid()) {

            $passwordSale = $passwordEncoder->encodePassword($participant, $participant->getMotDePasseParticipant());
            $participant->setMotDePasseParticipant($passwordSale);


            /**
             * @var UploadedFile $image
             */
            $slugify = new Slugify();
            $filename = $slugify->slugify($participant->getPseudo()) . "-" . $participant->getId() . ".jpg";

            $image = $participant->getPathImage();

            $imageManager = new ImageManager();
            $imageOrigine = $imageManager->make($image);
            $imageOrigine->resize(200);

            $imageOrigine->save($this->get('kernel')->getProjectDir()."\web\images\photoProfil\\".$filename);
            $participant->setPathImage('/images/photoProfil/' . $filename);

            $em->persist($participant);
            $em->flush();

            $this->addFlash('success', 'Le participant a bien été modifié');

            return $this->redirectToRoute('participant_afficherProfil', array('id' =>$participant->getId()));
        }

        return $this->render('participant/edit.html.twig', array(
            'participant' =>$participant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
   }


    /**
     * -------------PAS FINI CAR PERSONNES RATTACHEES A SORTIES---------------------
     * SUPPRIMER UN PARTICIPANT
     * @Route("/delete/{id}", name="participant_delete")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Participant $participant
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function deleteAction(Request $request, Participant $participant, EntityManagerInterface $em)
    {
       $formBuilder = $this->createFormBuilder();
       $formBuilder->add('suppression', SubmitType::class);

       $form = $formBuilder->getForm();

       $form->handleRequest($request);
       if ($form->isSubmitted()) {
           $em->remove($participant);
           $em->flush();

           $this->addFlash('success', 'Le participant a été supprimé');
           return $this->redirectToRoute('participant_index');
       }

       return $this->render('participant/delete.html.twig', [
        'participants' =>$participant,
        'form' => $form->createView()
    ]);

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