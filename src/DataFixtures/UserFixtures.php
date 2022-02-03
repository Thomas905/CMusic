<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('thomas@cmusic.com');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('Thomas');
        $user->setLastname('Clarisse');
        $user->setAdress('Rue des crevasses');
        $user->setCity('Lille');
        $user->setPostalcode('59000');
        $user->setPhone('0471840307');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'thomaspassword'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
