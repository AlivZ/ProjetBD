<?php

namespace HDW\MongoDBBundle\Controller;

use HDW\MongoDBBundle\Document\Developer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMongoDBBundle:Main:index.html.twig');
    }
}
