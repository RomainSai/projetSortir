<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sortie;
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
        $dateDuJour = new \DateTime();
        $dateDuJour->format('Y-m-d');
        $sites = $this->getDoctrine()->getRepository('AppBundle:Site')->findAll();
        $participant = $this->getDoctrine()->getRepository('AppBundle:Participant')->find($this->getUser());

        $dateDebut = $request->request->get('debut');
        $dateFin = $request->request->get('fin');
        unset($_POST);

        if(empty($dateFin)&& empty($dateFin)){
            $sorties = $this->getDoctrine()->getRepository('AppBundle:Sortie')->findAll();
        } else{
            $em = $this->getDoctrine()->getManager();
            $repoSortie = $em->getRepository(Sortie::class);
            $sorties = $repoSortie->trouverSortiesEntreDeuxDates($dateDebut,$dateFin);
        }

        // replace this example code with whatever you need
        return $this->render('layout.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'sites'=>$sites,
            'sorties'=>$sorties,
            'participant'=>$participant,
            'dateDuJour' =>$dateDuJour
        ]);
    }
}
