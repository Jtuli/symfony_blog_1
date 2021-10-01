<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ItemFixture extends Fixture
{

    public const CATEGORY_ITEM_REF = 'bt';

    public function load(ObjectManager $manager)
    {
        
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 20; $i++ ) {
            $item = new Item;

            $item
                ->setTitle($faker->words(3,true))
                ->setContent($faker->sentences(10, true))
                ->setVisible(true);

            $item->setCategory($this->getReference('cat_1'));
            $manager->persist($item);

            
      }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
