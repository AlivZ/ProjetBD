<?php

namespace HDW\MySQLBundle\Controller;

use HDW\MySQLBundle\Entity\Developer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMySQLBundle:Main:index.html.twig');
    }
}
