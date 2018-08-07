<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function add(Request $request)
    {
       $entity_manager = $this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)
            ->find($request->request->get('category_id'));
       $product = new Product();
       $product->setName($request->request->get('name'));
       $product->setCategory($category);
       $product->setQuantity($request->request->get('quantity'));
       $product->setPrice($request->request->get('price'));
       $product->updatedTimestamps();
       $entity_manager->persist($product);
       $entity_manager->flush();
       return new Response(1);
    }
}