<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ville;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ville controller.
 *
 * @Route("/ville", name="ville_")
 */
class VilleController extends Controller
{
    /**
     * Lists all ville entities.
     *  @Route("/", name="listeVilles")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villes = $em->getRepository('AppBundle:Ville')->findAll();

        return $this->render('ville/index.html.twig', array(
            'villes' => $villes,
        ));
    }

    /**
     * Creates a new ville entity.
     *
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ville = new Ville();
        $form = $this->createForm('AppBundle\Form\VilleType', $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_show', array('id' => $ville->getId()));
        }

        return $this->render('ville/new.html.twig', array(
            'ville' => $ville,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ville entity.
     *
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function showAction(Ville $ville)
    {
        $deleteForm = $this->createDeleteForm($ville);

        return $this->render('ville/show.html.twig', array(
            'ville' => $ville,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ville entity.
     *
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ville $ville)
    {
        $deleteForm = $this->createDeleteForm($ville);
        $editForm = $this->createForm('AppBundle\Form\VilleType', $ville);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_edit', array('id' => $ville->getId()));
        }

        return $this->render('ville/edit.html.twig', array(
            'ville' => $ville,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ville entity.
     *
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ville $ville)
    {
        $form = $this->createDeleteForm($ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
        }

        return $this->redirectToRoute('ville_index');
    }

    /**
     * Creates a form to delete a ville entity.
     *
     * @param Ville $ville The ville entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ville $ville)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ville_delete', array('id' => $ville->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
