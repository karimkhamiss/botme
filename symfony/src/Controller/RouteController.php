<?php
namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends AbstractController
{
    /**
            Check User Role to manage permissions
     */
    private function check_admin()
    {
        if($this->getUser())
        {
            if($this->getUser()->getRole() == "admin")
                return 1;
            else
                return 0;
        }
    }
    public function index()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $carts = $this->getDoctrine()->getRepository(Cart::class)->findAll();
        return $this->render("pages/index.html.twig", array(
            'products'=>$products,
            'categories'=>$categories,
            'carts'=>$carts,
            'page'=>"index",
            'user'=>$this->getUser()
        ));
    }
    public function cart($id)
    {
        if($this->getUser()) {
            if($this->getUser()->getClient())
            {
                $cart = $this->getDoctrine()->getRepository(Cart::class)
                    ->find($id);
                return $this->render("pages/cart.html.twig", array(
                    'cart' => $cart,
                    'user' => $this->getUser()
                ));
            }
        }
            return $this->render("pages/404.html.twig");
    }
    public function dashboard()
    {
        if($this->check_admin())
        {
            return $this->render("pages/home.html.twig", array(
                'page'=>'home',
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function categories()
    {
        if($this->check_admin())
        {
            $form = $this->createFormBuilder($task)
                ->add('task', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Create Task'))
                ->getForm();
            $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
            return $this->render("pages/categories.html.twig", array(
                'page'=>'categories',
                'categories'=>$categories,
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function products()
    {
        if($this->check_admin())
        {
            $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
            $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
            return $this->render("pages/products.html.twig", array(
                'page'=>'products',
                'categories'=>$categories,
                'products'=>$products,
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function sales()
    {
        if($this->check_admin())
        {
            $sales = $this->getDoctrine()->getRepository(Sale::class)->findAll();
            $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
            return $this->render("pages/sales.html.twig", array(
                'page'=>'sales',
                'sales'=>$sales,
                'products'=>$products,
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function clients()
    {
        if($this->check_admin())
        {
            $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
            return $this->render("pages/clients.html.twig", array(
                'page'=>'clients',
                'clients'=>$clients,
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function carts()
    {
        if($this->check_admin())
        {
            $carts = $this->getDoctrine()->getRepository(Cart::class)->findAll();
            return $this->render("pages/carts.html.twig", array(
                'page'=>'carts',
                'carts'=>$carts,
                'user'=>$this->getUser()
            ));
        }
        else
        {
            return $this->render("pages/404.html.twig");
        }

    }
    public function settings()
    {
        return $this->render("pages/settings.html.twig", array(
            'page'=>'settings'
        ));
    }
}