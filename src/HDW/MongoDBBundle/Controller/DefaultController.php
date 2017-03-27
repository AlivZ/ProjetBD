<?php

namespace HDW\MongoDBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMongoDBBundle:Main:index.html.twig');
    }
}
