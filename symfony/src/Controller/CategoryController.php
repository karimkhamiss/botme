<?php
namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    public function add(Request $request)
    {
        $category = new Category();
        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class,array(
                'label'=>false,
                'required'=>true,
                'attr' => array(
                    'placeholder' => 'Category Name',
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add Category',
                'attr' => array(
                    'class' => 'blue-btn',
                )
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entity_manager = $this->getDoctrine()->getManager();
            $entity_manager->persist($category);
            $entity_manager->flush();
            return $this->redirectToRoute('categories');
        }
        return $this->render('bases/form.html.twig',array(
            'form' =>$form->createView(),
            'page'=>"Add New Category",
            'user'=>$this->getUser(),
            'route_to_back'=>"/categories"
        ));
    }
}