<?php
// src/Form/AvisType.php

namespace App\Form;

use App\Entity\Suivit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operation',EntityType::class, [
                'class' => Suivit::class,
                'choice_value' => function (?Suivit $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'sujet',
            ])
            ->add('note', ChoiceType::class, [
                'choices' => [
                    '5 - Excellent' => 5,
                    '4 - Bon' => 4,
                    '3 - Moyen' => 3,
                    '2 - Mauvais' => 2,
                    '1 - Très mauvais' => 1,
                ],
                'label' => 'مستوى الرضا على تنفيذ المشروع',
                'required' => true,
            ])
            ->add('defaux', TextareaType::class, [
                'label' => 'إبلاغ عن عيوب خلال تنفيذ المشروع', // Label du champ
                'required' => false, // Facultatif
            ])
            ->add('danger', TextareaType::class, [
                'label' => 'الإعلان عن مخاطر أو تهديدات تواجه المشروع', // Label du champ
                'required' => false, // Facultatif
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Avis', // Spécifiez la classe de l'entité associée
        ]);
    }
}
