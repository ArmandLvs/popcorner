<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistFixtures extends Fixture implements DependentFixtureInterface
{
    public const PLAYLISTS = [
        [
            'name' => 'My favorite movies',
            'member' => 'john_doe',
            'description' => 'A playlist of my favorite movies',
            'movies' => [
                'The Matrix',
                'The Lord of the Rings: The Fellowship of the Ring',
            ],
            'published' => true,
        ],
        [
            'name' => 'LOTR Movies',
            'member' => 'john_doe',
            'description' => 'All movies in the Lord of the Rings universe',
            'movies' => [
                'The Lord of the Rings: The Fellowship of the Ring',
                'The Lord of the Rings: The Two Towers',
                'The Lord of the Rings: The Return of the King',
                'The Hobbit: An Unexpected Journey',
                'The Hobbit: The Desolation of Smaug',
                'The Hobbit: The Battle of the Five Armies',
            ],
            'published' => true,
        ],
        [
            'name' => 'The Matrix Trilogy',
            'member' => 'john_doe',
            'description' => 'All movies in the Matrix universe',
            'movies' => [
                'The Matrix',
                'The Matrix Reloaded',
                'The Matrix Revolutions',
            ],
            'published' => false,
        ],
        [
            'name' => 'The Dark Knight Trilogy',
            'member' => 'just_ken',
            'description' => 'All movies in the Dark Knight universe',
            'movies' => [
                'Batman Begins',
                'The Dark Knight',
                'The Dark Knight Rises',
            ],
            'published' => true,
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PLAYLISTS as $playlistData) {
            $playlist = new Playlist();
            $playlist->setName($playlistData['name']);
            $playlist->setDescription($playlistData['description']);
            $playlist->setMember($this->getReference($playlistData['member']));
            $playlist->setPublished($playlistData['published']);

            foreach ($playlistData['movies'] as $movieTitle) {
                $playlist->addMovie($this->getReference($movieTitle));
            }

            $this->addReference($playlistData['member'] . ': ' . $playlistData['name'], $playlist);

            $manager->persist($playlist);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MovieFixtures::class,
        ];
    }
}
