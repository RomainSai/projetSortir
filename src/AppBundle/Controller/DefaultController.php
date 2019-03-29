<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, EntityManagerInterface $em)
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

        //        verfication et modification des etats des sorties selon la date

        foreach ($sorties as $sortie){
            //ajout de la duree de la sortie à la date de la sortie
            $duree = $sortie->getDureeSortie();
            $dateDebutSortie = $sortie->getDateDebutSortie();
            $dateFinSortie = date('Y:m:d - H:i:s', strtotime("+{$duree} minutes"));

            if ($dateFinSortie > $dateDuJour && $dateDuJour> $dateDebutSortie){
                $etat = $em->getRepository('AppBundle:Etat')->find(3);
                $sortie->setEtat($etat);
            }elseif ($dateDuJour>$dateFinSortie){
                $etat = $em->getRepository('AppBundle:Etat')->find(4);
                $sortie->setEtat($etat);
            }
            $em->persist($sortie);
            $em->flush();
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
