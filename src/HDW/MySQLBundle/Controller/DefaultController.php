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

    public function addAction()
    {
        $timestart=microtime(true);
        $cpt = 0;
        while ($cpt < 1000) {
            $dev = new Developer();
            $dev->setName('De Wispelaere');
            $dev->setNickname('Hugo');
            $dev->setAge(23);
            $dev->setState('Stagiaire');
            $dev->setDbfav('MySQL');

            $em = $this->getDoctrine()->getManager();
            $em->persist($dev);
            $em->flush();

            $cpt++;
        }
        $timeend=microtime(true);
        $time=$timeend-$timestart;

        $page_load_time = number_format($time, 3);
        echo "Debut du script: ".date("H:i:s", $timestart);
        echo "<br>Fin du script: ".date("H:i:s", $timeend);
        echo "<br>Script execute en " . $page_load_time . " sec. </br>";

        return $this->render('HDWMySQLBundle:Main:added.html.twig');
    }
}
