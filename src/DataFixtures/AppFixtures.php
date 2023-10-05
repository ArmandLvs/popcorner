<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Library;
use App\Entity\Movie;
use App\Entity\Member;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create a member
        $member = new Member();
        $member->setNickname('john_doe');
        $member->setDescription('A member of the library');

        // Create a library
        $library = new Library();
        $library->setMember($member);
        $library->setDescription('A library');
        $member->setLibrary($library); // Link the library to the member

        // Create movies
        $movie1 = new Movie();
        $movie1->setTitle('The Matrix');
        $movie1->setyear(1999);
        $movie1->setImdbId('tt0133093');
        $movie1->setWatched(true);
        $movie1->setRating(5);
        $movie1->setReview('A great movie. I love it! I\'ve seen it 10 times. I\'ll see it again. And again. And again. And again. And again. And again. And again. And again. And again. And again.');
        $library->addMovie($movie1); // This also set the library of the movie

        $movie2 = new Movie();
        $movie2->setTitle('The Matrix Reloaded');
        $movie2->setYear(2003);
        $movie2->setImdbId('tt0234215');
        $movie2->setWatched(false);
        $library->addMovie($movie2); // This also set the library of the movie

        $movie3 = new Movie();
        $movie3->setTitle('The Matrix Revolutions');
        $movie3->setYear(2003);
        $movie3->setImdbId('tt0242653');
        $movie3->setWatched(false);
        $library->addMovie($movie3); // This also set the library of the movie

        // Persist the entities
        $manager->persist($member);
        $manager->persist($library);
        $manager->persist($movie1);
        $manager->persist($movie2);
        $manager->persist($movie3);

        // Save to database
        $manager->flush();
    }
}
