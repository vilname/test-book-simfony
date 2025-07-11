<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class BookAndAuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0;$i<3;$i++) {
            $this->create($faker, $manager);
        }

    }

    private function create(Generator $faker, ObjectManager $manager)
    {
        $authorModel = new Author();
        $authorModel->setFio($faker->name);

        $manager->persist($authorModel);
        $manager->flush();

        $id = $authorModel->getId();
        $manager->clear();

        $randInt = random_int(100000, 120000);

        $batch = 100;
        $qtyBatch = ceil($randInt / $batch);

        for ($j=0;$j<$batch;$j++) {
            $author = $manager->find(Author::class, $id);

            for ($i=0;$i<$qtyBatch;$i++) {
                $book = new Book();
                $book->setTitle($faker->sentence(2));
                $book->setAuthor($author);

                $manager->persist($book);
            }

            $manager->flush();
            $manager->clear();
        }
    }

}
