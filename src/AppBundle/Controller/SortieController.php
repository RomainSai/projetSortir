<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etat;
use AppBundle\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sortie controller.
 *
 * @Route("sortie")
 */
class SortieController extends Controller
{
    /**
     * Lists all sortie entities.
     *
     * @Route("/", name="sortie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sorties = $em->getRepository('AppBundle:Sortie')->findAll();

        return $this->render('sortie/index.html.twig', array(
            'sorties' => $sorties
        ));
    }

    /**
     * Creates a new sortie entity.
     *
     * @Route("/new", name="sortie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sortie = new Sortie();
        $form = $this->createForm('AppBundle\Form\SortieType', $sortie);
        $form->remove('urlPhoto');
        $form->remove('etat');
        $form->remove('participant');
        $form->remove('participants');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $valeurButtonSubmit = ($request->request->get('button'));
            $em = $this->getDoctrine()->getManager();
            $organisateur = $this->getUser();
            $sortie->setParticipant($organisateur);
            $sortie->addParticipant($organisateur);
            if ($valeurButtonSubmit == "save") {
                $etat = $em->getRepository('AppBundle:Etat')->find(1);
                $sortie->setEtat($etat);
            } elseif ($valeurButtonSubmit == "valide") {
                $etat = $em->getRepository('AppBundle:Etat')->find(2);
                $sortie->setEtat($etat);
            };
            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('homepage');//, array('id' => $sortie->getId()));
        }

        return $this->render('sortie/new.html.twig', array(
            'sortie' => $sortie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sortie entity.
     *
     * @Route("/{id}", name="sortie_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sortie = $em->getRepository('AppBundle:Sortie')->find($id);

        $participants = $sortie->getParticipants()->toArray();

        $deleteForm = $this->createDeleteForm($sortie);

        return $this->render('sortie/show.html.twig', array(
            'sortie' => $sortie,
            'delete_form' => $deleteForm->createView(),
            'participants' => $participants,
        ));
    }

    /**
     * Displays a form to edit an existing sortie entity.
     *
     * @Route("/{id}/edit", name="sortie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sortie $sortie)
    {
        $deleteForm = $this->createDeleteForm($sortie);
        $editForm = $this->createForm('AppBundle\Form\SortieType', $sortie);
        $editForm->remove('urlPhoto');
        $editForm->remove('etat');
        $editForm->remove('participant');
        $editForm->remove('participants');

        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $valeurButtonSubmit = ($request->request->get('button'));
            $em = $this->getDoctrine()->getManager();
            if ($valeurButtonSubmit == "save") {
                $etat = $em->getRepository('AppBundle:Etat')->find(1);
                $sortie->setEtat($etat);
            } elseif ($valeurButtonSubmit == "valide") {
                $etat = $em->getRepository('AppBundle:Etat')->find(2);
                $sortie->setEtat($etat);
            } else {
                $etat = $em->getRepository('AppBundle:Etat')->find(5);
                $sortie->setEtat($etat);
            }
            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('homepage', array('id' => $sortie->getId()));
        }

        return $this->render('sortie/edit.html.twig', array(
            'sortie' => $sortie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a sortie entity.
     *
     * @param Sortie $sortie The sortie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sortie $sortie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sortie_delete', array('id' => $sortie->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * @Route("/delete/{id}", name="sortie_delete")
     */
    public function deleteAction(Request $request, EntityManagerInterface $em, sortie $sortie)
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('annuler la sortie', SubmitType::class);

        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $etat = $em->getRepository('AppBundle:Etat')->find(5);
            $sortie->setEtat($etat);
            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        $this->addFlash('success', 'Etes-vous sur de vouloir supprimer'.$sortie);
        return $this->render('sortie/delete.html.twig', [
            'sortie' => $sortie,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Sortie $sortie
     * @Route("/{id}/inscrire", name="sortie_inscrire")
     *
     */
    public function inscrireAction(EntityManagerInterface $em, Sortie $sortie){

        $participantId = $this->getUser();
        $participant = $em->getRepository('AppBundle:Participant')->find($participantId);

        $sortie->addParticipant($participant);

        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @param EntityManagerInterface $em
     * @param Sortie $sortie
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/seDesister", name="sortie_desister")
     */
    public function desisterAction(EntityManagerInterface $em, Sortie $sortie){
        $participant = $this->getUser();

        $sortie->removeParticipant($participant);

        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }


}
