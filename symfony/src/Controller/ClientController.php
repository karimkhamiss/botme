<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\ClientCartProduct;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{

    public function add_to_cart($cart_id, $product_id)
    {
        $user = $this->getUser();
//        return new Response("USER ID = ".$user->getClient()->getAddress());
        $entity_manager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)
            ->find($product_id);
        $cart = $this->getDoctrine()->getRepository(Cart::class)
            ->find($cart_id);
        $client_cart_product = new ClientCartProduct();
        $client_cart_product->setClient($user->getClient());
        $client_cart_product->setCart($cart);
        $client_cart_product->setQuantity(1);
        $client_cart_product->setProduct($product);
        $entity_manager->persist($client_cart_product);
        $entity_manager->flush();
        return new Response(1);

    }
}
