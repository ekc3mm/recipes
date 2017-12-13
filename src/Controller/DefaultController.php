<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class DefaultController extends Controller
{
     /**
      * @Route("/",name="home")
      */
    public function number()
    {


        return new Response('ok');
    }
}
