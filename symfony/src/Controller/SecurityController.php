<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    public function login()
    {
    }

    public function logout()
    {
    }
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function signup(ObjectManager $manager,Request $request)
    {
        $user = new User();
        $user->setFirstname($request->request->get("firstname"));
        $user->setLastname($request->request->get("lastname"));
        $user->setUsername($request->request->get("username"));
        $user->setRole("client");
        $user->setPassword($this->encoder->encodePassword($user,$request->request->get("password")));
        $manager->persist($user);
        $manager->flush();
        $client = new Client();
        $client->setAddress($request->request->get("address"));
        $client->setPhone($request->request->get("phone"));
        $client->setUser($user);
        $manager->persist($client);
        $manager->flush();
        return new Response(1);
    }
}
