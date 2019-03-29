<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            ->add('dateDebutSortie', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('dureeSortie')
            ->add('dateCloture', DateTimeType::class, [
        'widget' => 'single_text',
            ])
            ->add('nbInscriptionMax')
            ->add('infoSortie')
            ->add('urlPhoto')
            ->add('etat')
            ->add('lieu', LieuType::class) //Pour récupérer le form de LieuType dans lequel
                                                        //on récupère aussi le form de VilleType.
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
