<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\Library;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MemberFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public const MEMBERS = [
        [
            'nickname' => 'john_doe',
            'member_description' => 'A member of the site',
            'library_description' => 'A library',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'roles' => ['ROLE_ADMIN']
        ],
        [
            'nickname' => 'just_ken',
            'member_description' => 'It\'s just Ken.',
            'library_description' => 'My library :D',
            'email' => 'just.ken@example.com',
            'password' => 'password123',
            'roles' => ['ROLE_USER']
        ]
    ];

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEMBERS as $memberData) {
            $member = new Member();
            $member->setNickname($memberData['nickname']);
            $member->setDescription($memberData['member_description']);

            $user = new User();
            $password = $this->hasher->hashPassword($user, $memberData['password']);
            $user->setEmail($memberData['email']);
            $user->setPassword($password);
            $user->setRoles($memberData['roles']);
            $user->setMember($member);

            $library = new Library();
            $library->setMember($member);
            $library->setDescription($memberData['library_description']);

            $manager->persist($user);
            $manager->persist($member);
            $manager->persist($library);

            $this->addReference($memberData['nickname'], $member);
            $this->addReference($memberData['nickname'] . '_library', $library);
        }

        $manager->flush();
    }
}
