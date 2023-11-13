<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\Library;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemberFixtures extends Fixture
{
    public const MEMBERS = [
        [
            'nickname' => 'john_doe',
            'member_description' => 'A member of the site',
            'library_description' => 'A library'
        ],
        [
            'nickname' => 'just_ken',
            'member_description' => 'It\'s just Ken.',
            'library_description' => 'My library :D'
        ]
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::MEMBERS as $memberData) {
            $member = new Member();
            $member->setNickname($memberData['nickname']);
            $member->setDescription($memberData['member_description']);

            $library = new Library();
            $library->setMember($member);
            $library->setDescription($memberData['library_description']);

            $manager->persist($member);
            $manager->persist($library);

            $this->addReference($memberData['nickname'], $member);
            $this->addReference($memberData['nickname'] . '_library', $library);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
