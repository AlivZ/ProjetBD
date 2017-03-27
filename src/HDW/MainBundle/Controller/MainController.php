<?php

namespace HDW\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HDW\MongoDBBundle\Document\Dev;
use HDW\MySQLBundle\Entity\Developer;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMainBundle:Main:index.html.twig');
    }

    public function insertAction()
    {
        $timestartmysql=microtime(true);
        $cptdevv = 0;
        while ($cptdevv < 1000) {
            $dev = new Developer();
            $dev->setName('De Wispelaere');
            $dev->setNickname('Hugo');
            $dev->setAge(23);
            $dev->setState('Stagiaire');
            $dev->setDbfav('MySQL');

            $em = $this->getDoctrine()->getManager();
            $em->persist($dev);
            $em->flush();

            $cptdevv++;
        }
        $timeendmysql=microtime(true);
        $timemysql=$timeendmysql-$timestartmysql;


        $timestartmongo=microtime(true);
        $cptdev = 0;
        while ($cptdev < 1000) {
            $dev = new Dev();
            $dev->setName('De Wispelaere');
            $dev->setNickname('Hugo');
            $dev->setAge(23);
            $dev->setState('Stagiaire');
            $dev->setDbfav('MongoDB');

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($dev);
            $dm->flush();

            $cptdev++;
        }
        $timeendmongo=microtime(true);
        $timemongo=$timeendmongo-$timestartmongo;

        return $this->render('HDWMainBundle:Main:added.html.twig',array('timeinsertmongo' => $timemongo,'timeinsertmysql' => $timemysql));
    }
}