<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CatFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $cat1 = new Category();
        $cat1->setName("Beauty");

        $manager->persist($cat1);
        $this->addReference('cat_1', $cat1);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
