<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CartFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $cart = new Cart();
        $cart->setName("Shopping");
         $manager->persist($cart);
        $manager->flush();
         $cart = new Cart();
        $cart->setName("WishList");
         $manager->persist($cart);
        $manager->flush();
    }
}
