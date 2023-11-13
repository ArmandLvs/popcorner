<?php

namespace App\Form;

use App\Entity\Playlist;
use App\Repository\MovieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $playlist = $options['data'] ?? null;
        $member = $playlist->getMember();

        $builder
            ->add('name')
            ->add('description', null, [
                'required' => false,
            ])
            ->add('published')
        ->add('member', null, [
            'disabled' => true,
        ])
            ->add('movies', null, [
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'query_builder' => function (MovieRepository $movieRepository) use ($member) {
                    return $movieRepository->createQueryBuilder('movie')
                        ->andWhere('movie.library = :library')
                        ->setParameter('library', $member->getLibrary());
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
