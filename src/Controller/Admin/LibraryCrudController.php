<?php

namespace App\Controller\Admin;

use App\Entity\Library;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class LibraryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Library::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new("description"),
            AssociationField::new("movies"),
        ];
    }
}
