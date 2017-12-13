<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * @Route("/all", name="post-all")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('@Maker/demoPage.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);
    }

    /**
     * @Route("/add",name="post-add")
     */
    public function add(Request $request)
    {
        $post = new Post();


        $form = $this->createFormBuilder($post)
            ->add('name',TextType::class)
            ->add('text',TextType::class,[

            ])
            ->add('category',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'name',
                'disabled'=>true,
            ])
            ->add('tags',EntityType::class,[
                'class'=>Tag::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true
            ])

            ->add('save',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }
        return $this->render('post/add.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/all",name="post-all")
     */
    public function all()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('post/all.html.twig',['posts'=>$posts]);
    }
}
