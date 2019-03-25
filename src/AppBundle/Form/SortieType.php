<?php

namespace AppBundle\Form;

use AppBundle\Entity\Lieu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomSortie')
            ->add('dateDebutSortie')
            ->add('dureeSortie')
            ->add('dateCloture')
            ->add('nbInscriptionMax')
            ->add('infoSortie')
            ->add('urlPhoto')
            ->add('etat')
            ->add('lieu', LieuType::class)
            ->add('site')
            ->add('participant')
            ->add('participants');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sortie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sortie';
    }


}
