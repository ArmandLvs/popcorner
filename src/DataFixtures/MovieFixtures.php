<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public const MOVIES = [
        [
            'title' => 'The Matrix',
            'year' => 1999,
            'imdbId' => 'tt0133093',
            'watched' => true,
            'rating' => 5,
            'review' => 'A great movie. I love it! I\'ve seen it 10 times. I\'ll see it again. And again. And again. And again. And again. And again. And again. And again. And again. And again.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Matrix Reloaded',
            'year' => 2003,
            'imdbId' => 'tt0234215',
            'watched' => false,
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Matrix Revolutions',
            'year' => 2003,
            'imdbId' => 'tt0242653',
            'watched' => false,
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'year' => 2001,
            'imdbId' => 'tt0120737',
            'watched' => true,
            'rating' => 5,
            'review' => 'Wow. Just wow. How can you not love this movie? It\'s a masterpiece.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Lord of the Rings: The Two Towers',
            'year' => 2002,
            'imdbId' => 'tt0167261',
            'watched' => true,
            'rating' => 5,
            'review' => 'Still a masterpiece.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Lord of the Rings: The Return of the King',
            'year' => 2003,
            'imdbId' => 'tt0167260',
            'watched' => true,
            'rating' => 5,
            'review' => 'Perfect ending to a perfect trilogy.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Hobbit: An Unexpected Journey',
            'year' => 2012,
            'imdbId' => 'tt0903624',
            'watched' => false,
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Hobbit: The Desolation of Smaug',
            'year' => 2013,
            'imdbId' => 'tt1170358',
            'watched' => false,
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Hobbit: The Battle of the Five Armies',
            'year' => 2014,
            'imdbId' => 'tt2310332',
            'watched' => false,
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Shawshank Redemption',
            'year' => 1994,
            'imdbId' => 'tt0111161',
            'watched' => true,
            'rating' => 2,
            'review' => 'Okay I know a lot of people love this movie but I don\'t get it. It\'s just a prison movie. I\'ve seen it once and I don\'t want to see it again.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Godfather',
            'year' => 1972,
            'imdbId' => 'tt0068646',
            'watched' => true,
            'rating' => 5,
            'review' => 'Yeah, it\'s a classic. I\'ve seen it 3 times. I\'ll see it again.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'The Godfather: Part II',
            'year' => 1974,
            'imdbId' => 'tt0071562',
            'watched' => true,
            'rating' => 5,
            'review' => 'What a great sequel.',
            'library' => 'john_doe_library'
        ],
        [
            'title' => 'Batman Begins',
            'year' => 2005,
            'imdbId' => 'tt0372784',
            'watched' => true,
            'rating' => 4,
            'review' => 'Nice take on the Batman story.',
            'library' => 'just_ken_library'
        ],
        [
            'title' => 'The Dark Knight',
            'year' => 2008,
            'imdbId' => 'tt0468569',
            'watched' => false,
            'library' => 'just_ken_library'
        ],
        [
            'title' => 'The Dark Knight Rises',
            'year' => 2012,
            'imdbId' => 'tt1345836',
            'watched' => false,
            'library' => 'just_ken_library'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MOVIES as $movieData) {
            $movie = new Movie();
            $movie->setTitle($movieData['title']);
            $movie->setYear($movieData['year']);
            $movie->setImdbId($movieData['imdbId']);
            $movie->setWatched($movieData['watched']);
            $movie->setLibrary($this->getReference($movieData['library']));

            if (isset($movieData['rating'])) {
                $movie->setRating($movieData['rating']);
            }

            if (isset($movieData['review'])) {
                $movie->setReview($movieData['review']);
            }

            $this->addReference($movieData['title'], $movie);
            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MemberFixtures::class,
        ];
    }
}
