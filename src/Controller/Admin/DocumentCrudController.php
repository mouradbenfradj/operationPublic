<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('titre'),
            ImageField::new('fileName')->setBasePath('/uploads/pdf/')->setUploadDir('public/uploads/pdf/')   ->formatValue(function ($value, $entity) {
                // Afficher le nom du fichier avec une icône PDF personnalisée depuis le web
                return sprintf('<img src="%s" alt="PDF Icon" style="width: 20px; height: auto;"> %s', 
                               'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                               basename($value));
            }),
            ChoiceField::new('menuCyble')->setChoices(
                [
                    'الإطار القانوني' => 1,
                    'تجارب نموذجية' => 2,
                    'إدارة المشاريع' => 3,
                    'إدارة المخاطر' => 4,
                    'إدارة الوقت' => 5,
                    'استخدام التكنولوجيا الحديثة' => 6,
                ],
            )
        ];
    }
}
