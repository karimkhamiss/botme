<?php
namespace App\Controller;

use App\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    public function add(Request $request)
    {
        $cart = new Cart();
        $form = $this->createFormBuilder($cart)
            ->add('name', TextType::class,array(
                'label'=>false,
                'required'=>true,
                'attr' => array(
                    'placeholder' => 'Cart Name',
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add Cart',
                'attr' => array(
                    'class' => 'blue-btn',
                )
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $form->getData();
            $entity_manager = $this->getDoctrine()->getManager();
            $entity_manager->persist($cart);
            $entity_manager->flush();
            return $this->redirectToRoute('carts');
        }
        return $this->render('bases/form.html.twig',array(
            'form' =>$form->createView(),
            'page'=>"Add New Cart",
            'user'=>$this->getUser(),
            'route_to_back'=>"/carts"
        ));
    }
}