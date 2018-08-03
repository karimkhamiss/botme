<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends AbstractController
{
    public function index()
    {
        return $this->render("pages/index.html.twig");
    }
    public function home()
    {
        return $this->render("pages/home.html.twig");
    }
    public function categories()
    {
        return $this->render("pages/categories.html.twig");
    }
}