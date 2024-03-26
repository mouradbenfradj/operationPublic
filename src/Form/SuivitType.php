<?php

namespace App\Form;

use App\Entity\Suivit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuivitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nature')
            ->add('sujet')
            ->add('cout')
            ->add('proprietaire')
            ->add('debut')
            ->add('fin')
            ->add('jourDeRetard')
            ->add('causeRetard')
            ->add('dateCauseResiliation')
            ->add('dateValidationFinal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Suivit::class,
        ]);
    }
}
