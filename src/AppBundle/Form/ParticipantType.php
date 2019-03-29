<?php

namespace AppBundle\Form;

use AppBundle\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', TextType::class)
            ->add('prenomParticipant', TextType::class)
            ->add('nomParticipant', TextType::class)
            ->add('telephoneParticipant', TelType::class)
            ->add('mailParticipant', EmailType::class)
            ->add('motDePasseParticipant', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être identique',
                'options' => ['attr' => ['class' => 'password-field' ]],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' =>['label' => 'Confirmation mot de passe'],
                ])

            ->add('site', EntityType::class, [
                'class'=> Site::class,
                'choice_label'=> 'nomSite'
                ] )
            ->add('pathImage', FileType::class, array(
                'data_class' =>null,
                'label'=>'Photo profil',
                'required' => false))

            //->add('administrateur', CheckboxType::class)
            //->add('actif',CheckboxType::class)

            ->add('Enregistrer', SubmitType::class);
//            ->add('Annuler', SubmitType::class);

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_participant';
    }
}
