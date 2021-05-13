<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('poste', 'Poste occupé'),
            ImageField::new('image', 'Photo')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),
            BooleanField::new('visible', 'Visibilité du membre'),
            ChoiceField::new('visible', 'Visibilité du membre')
                ->setChoices([
                    'Visible' => 1,
                    'Non Visible' => 0,
                ])->hideOnIndex(),
        ];
    }

}
