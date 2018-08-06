<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
       $user = new User();
       $user->setFirstname("Admin");
       $user->setLastname("");
       $user->setUsername("admin");
       $user->setRole("admin");
       $user->setPassword($this->encoder->encodePassword($user,"123"));
        $manager->persist($user);
        $manager->flush();
       $user = new User();
       $user->setFirstname("Client");
       $user->setLastname("");
       $user->setUsername("client");
        $user->setRole("client");
        $user->setPassword($this->encoder->encodePassword($user,"123"));
        $manager->persist($user);
        $manager->flush();
       $client = new Client();
        $client->setAddress("Ain Shams");
        $client->setPhone("01210073443");
        $client->setUser($user);
        $manager->persist($client);
        $manager->flush();
    }
}
