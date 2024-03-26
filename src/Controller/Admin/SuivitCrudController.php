<?php

namespace App\Controller\Admin;

use App\Entity\Suivit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SuivitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suivit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('nature')->renderExpanded()->setChoices([
                'أشغال' => 1,
                'دراسة' => 2,
                'تزود بخدمات' => 3,
            ]),
            TextField::new('sujet'),
            TextField::new('proprietaire'),
            NumberField::new('cout'),
            DateField::new('debut'),
            DateField::new('fin'),
            NumberField::new('jourDeRetard'),
            TextareaField::new('causeRetard'),
            TextareaField::new('dateCauseResiliation'),
            DateField::new('dateValidationFinal'),
        ];
    }
    
}
