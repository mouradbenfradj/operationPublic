<?php
// src/Form/AvisType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('satisfaction', TextareaType::class, [
                'label' => 'مستوى الرضا على تنفيذ المشروع', // Label du champ
                'required' => false, // Facultatif
            ])
            ->add('defauts', TextareaType::class, [
                'label' => 'إبلاغ عن عيوب خلال تنفيذ المشروع', // Label du champ
                'required' => false, // Facultatif
            ])
            ->add('risques', TextareaType::class, [
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
