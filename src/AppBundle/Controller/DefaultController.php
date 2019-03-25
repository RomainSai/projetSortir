<?php

namespace AppBundle\Controller;

use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $sites = $this->getDoctrine()->getRepository('AppBundle:Site')->findAll();
        $sorties = $this->getDoctrine()->getRepository('AppBundle:Sortie')->findAll();
        $participant = $this->getDoctrine()->getRepository('AppBundle:Participant')->find($this->getUser());

        dump($participant);
        $sortiesPourOrganisateur = $participant->getSorties()->toArray();
        dump($sortiesPourOrganisateur);
        // replace this example code with whatever you need
        return $this->render('layout.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'sites'=>$sites,
            'sorties'=>$sorties,
            'participant'=>$participant,
            'sortiesPourOrganisateur'=>$sortiesPourOrganisateur

        ]);
    }
}
