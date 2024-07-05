<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct( private readonly UserPasswordHasherInterface $hasher)
    {

    }


    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        $user = (new User());
        $user->setRoles(['ROLE_ADMIN'])
            ->setEmail('aurelien@aurelien.fr')
            ->setLastname('Vézine')
            ->setFirstname('Aurélien')
            ->setPassword($this->hasher->hashPassword($user, 'aurel89,'));
        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $user = (new User());
            $user->setRoles(['ROLE_EMPLOYER'])
                ->setEmail($faker->email)
                ->setLastname($faker->lastName)
                ->setFirstname($faker->firstName)
                ->setPassword($this->hasher->hashPassword($user, '0000'));
            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
