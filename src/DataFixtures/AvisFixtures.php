<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AvisFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); // create a French faker
        for ($i = 0; $i < 20; $i++) {
            $avis = (new Avis())
                    ->setPseudo($faker->unique()->userName())
                    ->setComments($faker->text(200))
                    ->setVisible($faker->boolean());
                $manager->persist($avis);


        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
