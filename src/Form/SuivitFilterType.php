<?php
// src/Form/SuivitFilterType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Avis;
use App\Entity\Suivit;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
                'expanded' => true,
                'multiple' => false,
                'required' => false,
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'موضوع الصفقة',
                'choices' => [],
                'required' => false,
                // Ajoutez un écouteur d'événements pour modifier la visibilité des autres champs
                'attr' => [
                    'onchange' => 'toggleAvisFields(this)',
                ],
            ])
            ->add('satisfaction', TextareaType::class, [
                'label' => 'مستوى الرضا على تنفيذ المشروع',
                'required' => false,
                'mapped' => false, // Ne pas mapper ce champ à une propriété de l'entité Suivit
                'attr' => [
                    'style' => 'display:none', // Masquer ce champ par défaut
                ],
            ])
            ->add('defauts', TextareaType::class, [
                'label' => 'إبلاغ عن عيوب خلال تنفيذ المشروع',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'style' => 'display:none',
                ],
            ])
            ->add('risques', TextareaType::class, [
                'label' => 'الإعلان عن مخاطر أو تهديدات تواجه المشروع',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'style' => 'display:none',
                ],
            ])->add('submit', SubmitType::class, [
                'label' => 'Soumettre', // Texte du bouton
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suivit::class,
        ]);
    }
}
