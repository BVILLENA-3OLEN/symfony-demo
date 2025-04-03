<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');

        for ($i = 0; $i < 20; ++$i) {
            $post = new Post();
            $post
                ->setTitle($faker->realTextBetween(minNbChars: 10, maxNbChars: 50))
                ->setAuthor($faker->name())
                ->setContent($faker->realText())
                ->setPublishedAt(
                    \DateTimeImmutable::createFromMutable(
                        $faker->dateTimeBetween(startDate: '-20 days', endDate: '+5 days')
                    )
                );

            $manager->persist($post);
        }

        $manager->flush();
    }
}
