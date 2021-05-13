<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre', 'Titre de l\'article'),
            AssociationField::new('category', 'Catégorie de thématique'),
            TextEditorField::new('contenu'),
            DateField::new('createdAt')->hideOnForm(),

            /*vignette*/
            ImageField::new('vignette', 'Vignette')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),

            /*image 1*/
            ImageField::new('image', 'Image 1')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),
            /*image 2*/
            ImageField::new('image2', 'Image 2')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),
            /*image 3*/
            ImageField::new('image3', 'Image 3')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),
            UrlField::new('video', 'Lien vidéo youtube (avec embed)'),

        ];
    }

}
