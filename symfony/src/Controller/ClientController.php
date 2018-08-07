<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Client;
use App\Entity\ClientCartProduct;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{

    /**
     * Return Total Cart to be live updated
     */
    public function add_to_cart($cart_id, $product_id)
    {
        if($this->getUser()) {
            if($this->getUser()->getClient())
            {
                $user = $this->getUser();
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
                return new JsonResponse(array(
                    'cart' => "Cart".$cart_id,
                    'total' => $client_cart_product->getCart()->getTotal($user->getClient()->getId())
                ));
            }
            else
                return new Response(2);
        }
        else
            return new Response(0);

    }
    public function remove_from_cart($client_cart_product_id)
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $client_cart_product = $this->getDoctrine()->getRepository(ClientCartProduct::class)
            ->find($client_cart_product_id);
        $entity_manager->remove($client_cart_product);
        $entity_manager->flush();
        return new Response(1);
    }
    public function update_cart(Request $request)
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $client_cart_product = $this->getDoctrine()->getRepository(ClientCartProduct::class)
            ->find($request->request->get('id'));
        if($request->request->get('quantity') <= $client_cart_product->getProduct()->getQuantity())
        {
            $client_cart_product->setQuantity($request->request->get('quantity'));
            $entity_manager->flush();
            return new Response(1);
        }
        else
            return new Response(0);
    }
    public function empty_cart($cart_id,$client_id)
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $client = $this->getDoctrine()->getRepository(Client::class)->find($client_id);
        $cart = $this->getDoctrine()->getRepository(Cart::class)->find($cart_id);
        $client_cart_product_to_delete_query = $this->getDoctrine()->getRepository(ClientCartProduct::class)
            ->createQueryBuilder('ccp')
            ->where('ccp.client = :client')
            ->andWhere('ccp.cart = :cart')
            ->setParameters(array('client'=>$client,'cart'=>$cart))
            ->getQuery();
        $client_cart_product_to_delete_array = $client_cart_product_to_delete_query->execute();
        foreach ($client_cart_product_to_delete_array as $client_cart_product_to_delete_item)
        {
            $entity_manager->remove($client_cart_product_to_delete_item);
            $entity_manager->flush();
        }
        return new Response(1);
    }
}
