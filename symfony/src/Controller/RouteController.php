<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends AbstractController
{
    public function index()
    {
        return $this->render("pages/index.html.twig", array(
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
        return $this->render("pages/categories.html.twig", array(
            'page'=>'categories'
        ));
    }
    public function products()
    {
        return $this->render("pages/products.html.twig", array(
            'page'=>'products'
        ));
    }
    public function sales()
    {
        return $this->render("pages/sales.html.twig", array(
            'page'=>'sales'
        ));
    }
    public function clients()
    {
        return $this->render("pages/clients.html.twig", array(
            'page'=>'clients'
        ));
    }
    public function carts()
    {
        return $this->render("pages/carts.html.twig", array(
            'page'=>'carts'
        ));
    }
    public function settings()
    {
        return $this->render("pages/settings.html.twig", array(
            'page'=>'settings'
        ));
    }
}