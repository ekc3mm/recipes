<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/tag")
 */

class TagController extends Controller
{
    /**
     * @Route("/add", name="tag-add")
     */
    public function index(Request $request)
    {
        $tag = new Tag();
        $form = $this->createFormBuilder($tag)
            ->add('name',TextType::class)
            ->add('save',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $tag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
        }
        return $this->render('tag/add.html.twig',['form'=>$form->createView()]);


    }
}
