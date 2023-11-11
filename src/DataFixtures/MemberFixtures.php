<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\Library;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemberFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $member = new Member();
        $member->setNickname('john_doe');
        $member->setDescription('A member of the site');

        $library = new Library();
        $library->setMember($member);
        $library->setDescription('A library');

        $manager->persist($member);
        $manager->persist($library);
        $manager->flush();

        $this->addReference('john_doe', $member);
        $this->addReference('john_doe_library', $library);
    }
}
