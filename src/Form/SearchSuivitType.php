<?php

namespace App\Form;

use App\Entity\Suivit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SearchSuivitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('nature', ChoiceType::class, [
            'choices' => [
                'أشغال' => 1,
                'دراسة' => 2,
                'تزود بخدمات' => 3,
                // Ajoutez d'autres options selon vos besoins
            ],
            'label' => 'طبيعة الصفقة',
            'expanded' => true,
            'multiple' => false,
            'required' => false,
            'mapped' => false,
        ])
        ->add('sujet', null, ['required' => false, 'mapped' => false])
        ->add('cout', null, ['required' => false, 'mapped' => false])
        ->add('proprietaire', null, ['required' => false, 'mapped' => false])
        ->add('debut', DateType::class, [
            'required' => false,
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'mapped' => false,
        ])
        ->add('fin', DateType::class, [
            'required' => false,
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'mapped' => false,
        ])
        ->add('jourDeRetard', null, ['required' => false, 'mapped' => false])
        ->add('causeRetard', null, ['required' => false, 'mapped' => false])
        ->add('dateCauseResiliation', null, ['required' => false, 'mapped' => false])
        ->add('dateValidationFinal', DateType::class, [
            'required' => false,
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'mapped' => false,
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Suivit::class,
            'csrf_protection' => false, // Disable CSRF protection for search forms
        ]);
    }
}
