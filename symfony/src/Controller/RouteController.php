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
}