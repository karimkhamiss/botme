<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends AbstractController
{
    public function index()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render("pages/index.html.twig", array(
            'products'=>$products,
            'categories'=>$categories
        ));
    }
    public function cart($id)
    {
        return $this->render("pages/cart.html.twig", array(
        ));
    }
    public function dashboard()
    {
        return $this->render("pages/home.html.twig", array(
            'page'=>'home'
        ));
    }
    public function categories()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render("pages/categories.html.twig", array(
            'page'=>'categories',
            'categories'=>$categories
        ));
    }
    public function products()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render("pages/products.html.twig", array(
            'page'=>'products',
            'categories'=>$categories,
            'products'=>$products,
        ));
    }
    public function sales()
    {
        $sales = $this->getDoctrine()->getRepository(Sale::class)->findAll();
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render("pages/sales.html.twig", array(
            'page'=>'sales',
            'sales'=>$sales,
            'products'=>$products
        ));
    }
    public function clients()
    {
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render("pages/clients.html.twig", array(
            'page'=>'clients',
            'clients'=>$clients
        ));
    }
    public function carts()
    {
//        $carts = $this->getDoctrine()->getRepository(Cart::class)->findAll();
        return $this->render("pages/carts.html.twig", array(
            'page'=>'carts',
//            'carts'=>$carts
        ));
    }
    public function settings()
    {
        return $this->render("pages/settings.html.twig", array(
            'page'=>'settings'
        ));
    }
}