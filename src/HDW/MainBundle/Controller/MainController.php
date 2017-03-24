<?php

namespace HDW\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMainBundle:Main:index.html.twig');
    }
}