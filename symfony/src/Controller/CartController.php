<?php
namespace App\Controller;

use App\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    public function add(Request $request)
    {
       $entity_manager = $this->getDoctrine()->getManager();
       $cart = new Cart();
       $cart->setName($request->request->get('name'));
       $entity_manager->persist($cart);
       $entity_manager->flush();
       return new Response(1);
    }
}