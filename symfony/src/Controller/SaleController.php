<?php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends AbstractController
{
    public function calculate($id,$sale_value)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)
            ->find($id);
        $before_sale = $product->getPrice();
        $after_sale = $before_sale-(($sale_value/100)*$before_sale);
        return new JsonResponse(array(
            'before_sale' => $before_sale,
            'after_sale' => $after_sale
        ));
    }
    public function add(Request $request)
    {
       $entity_manager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)
            ->find($request->request->get('product_id'));
       $sale = new Sale();
       $sale->setValue($request->request->get('value'));
       $sale->setProduct($product);
       $sale->updatedTimestamps();
       $entity_manager->persist($sale);
       $entity_manager->flush();
       return new Response(1);
    }
    public function delete(Request $request)
    {
       $sale = $this->getDoctrine()->getRepository(Sale::class)
           ->find($request->request->get('id'));
       $entity_manager = $this->getDoctrine()->getManager();
       $entity_manager->remove($sale);
       $entity_manager->flush();
       return new Response(1);
    }
}