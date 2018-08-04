<?php
namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    public function add(Request $request)
    {
       $entity_manager = $this->getDoctrine()->getManager();
       $category = new Category();
       $category->setName($request->request->get('name'));
       $entity_manager->persist($category);
       $entity_manager->flush();
       return new Response(1);
    }
    public function delete(Request $request)
    {
       $category = $this->getDoctrine()->getRepository(Category::class)
           ->find($request->request->get('id'));
       $entity_manager = $this->getDoctrine()->getManager();
       $entity_manager->remove($category);
       $entity_manager->flush();
       return new Response(1);


    }
}