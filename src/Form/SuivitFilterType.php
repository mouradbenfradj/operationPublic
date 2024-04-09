<?php

namespace App\Form;

use App\Entity\Suivit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SuivitRepository;

class SuivitFilterType extends AbstractType
{
    private $entityManager;
    private $suivitRepository;

    public function __construct(EntityManagerInterface $entityManager, SuivitRepository $suivitRepository)
    {
        $this->entityManager = $entityManager;
        $this->suivitRepository = $suivitRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $natureChoices = $this->getUniqueNatureValues();

        $builder
            ->add('operation', ChoiceType::class, [
                'choices' => array_flip($natureChoices),
                'label' => 'العملية',
                'required' => false,
                'expanded' => true,
                'multiple' => false,
                'mapped' => false,
            ])
            ->add('note', ChoiceType::class, [
                'choices' => [
                    '5 - ممتاز' => 5,
                    '4 - جيد' => 4,
                    '3 - متوسط' => 3,
                    '2 - سيء' => 2,
                    '1 - سيء جدا' => 1,
                ],
                'label' => 'تقييم التنفيذ',
                'required' => true,
            ])
            ->add('defaux', TextareaType::class, [
                'label' => 'إبلاغ عن عيوب خلال تنفيذ المشروع',
                'required' => false,
            ])
            ->add('danger', TextareaType::class, [
                'label' => 'الإعلان عن مخاطر أو تهديدات تواجه المشروع',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suivit::class,
        ]);
    }

    private function getUniqueNatureValues()
    {
        $results = $this->suivitRepository->findDistinctNatureValues();

        $uniqueNatureValues = [];
        foreach ($results as $result) {
            $uniqueNatureValues[$result['nature']] = $this->getNatureLabel($result['nature']);
        }

        return $uniqueNatureValues;
    }

    private function getNatureLabel($nature)
    {
        switch ($nature) {
            case 1:
                return 'أشغال';
            case 2:
                return 'دراسة';
            case 3:
                return 'تزود بخدمات';
            default:
                return 'Inconnu';
        }
    }
    
}
