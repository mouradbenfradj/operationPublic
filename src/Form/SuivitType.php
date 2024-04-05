<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\Suivit;
use App\Repository\SuivitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuivitType extends AbstractType
{

    private $entityManager;
    private $suivitRepository;

    public function __construct(EntityManagerInterface $entityManager, SuivitRepository $suivitRepository)
    {
        $this->entityManager = $entityManager;
        $this->suivitRepository = $suivitRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $natureChoices = $this->getUniqueNatureValues();
        $builder
            ->add('nature', ChoiceType::class, [
                'choices' => array_flip($natureChoices),
                'label' => 'العملية',
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'mapped' => false,
            ])
            
            /* ->add('cout')
            ->add('proprietaire')
            ->add('debut')
            ->add('fin')
            ->add('jourDeRetard')
            ->add('causeRetard')
            ->add('dateCauseResiliation')
            ->add('dateValidationFinal') */
            ->add('avis', CollectionType::class, [
                'entry_type' => AvisType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
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
