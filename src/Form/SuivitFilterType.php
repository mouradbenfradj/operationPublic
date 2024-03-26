<?php
// src/Form/SuivitFilterType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuivitFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
                'expanded' => true, // Afficher comme des boutons radio
                'multiple' => false, // Ne pas autoriser la sélection multiple
                'required' => false, // Facultatif selon vos besoins
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'موضوع الصفقة',
                'choices' => [], // Les choix seront mis à jour dynamiquement
                'required' => false, // Facultatif selon vos besoins
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez les options de base ici
        ]);
    }
}
