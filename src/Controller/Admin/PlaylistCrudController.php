<?php

namespace App\Controller\Admin;

use App\Entity\Playlist;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            AssociationField::new('member'),
            BooleanField::new('published')
                ->onlyOnForms()
                ->hideWhenCreating(),
            TextareaField::new('description'),

            AssociationField::new('movies')
                ->hideOnIndex()
                ->hideWhenCreating()
                ->setTemplatePath('admin/fields/library_movies.html.twig')
                ->setQueryBuilder(
                    function (QueryBuilder $queryBuilder) {
                        $currentPlaylist = $this->getContext()->getEntity()->getInstance();
                        $member = $currentPlaylist->getMember();
                        $memberId = $member->getId();

                        // select * from movie
                        //       LEFT JOIN library on library_id library.id
                        //       LEFT JOIN member on library.member = member.id
                        //       WHERE member.id = :member_id

                        $queryBuilder
                            ->leftJoin('entity.library', 'i')
                            ->leftJoin('i.member', 'm')
                            ->andWhere('m.id = :member_id')
                            ->setParameter('member_id', $memberId);

                        return $queryBuilder;
                    }
                ),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
