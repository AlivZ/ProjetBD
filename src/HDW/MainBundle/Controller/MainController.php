<?php

namespace HDW\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HDW\MongoDBBundle\Document\Dev;
use HDW\MainBundle\Builder\DevBuilder;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMainBundle:Main:index.html.twig');
    }

    public function insertAction()
    {
        //INSERT MYSQL
        $timeinsertstartmysql=microtime(true);
        $cptdevv = 0;
        while ($cptdevv < 50) {

            $buildermysql = new DevBuilder();
            $devmysql =  $buildermysql->buildDevMySQL();

            $em = $this->getDoctrine()->getManager();
            $em->persist($devmysql);
            $em->flush();

            $cptdevv++;
        }
        $timeinsertendmysql=microtime(true);
        $timeinsertmysql=$timeinsertendmysql-$timeinsertstartmysql;

        //SELECT* MYSQL
        $timeselectstartmysql=microtime(true);
        $cptdevo = 0;
        while ($cptdevo < 50) {
            $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');
            $listDevelopers = $repository->findIn2017();
            $cptdevo++;
        }

        $timeselectendmysql=microtime(true);
        $timeselectmysql=$timeselectendmysql-$timeselectstartmysql;

        //REMOVE MYSQL
        $timeremovestartmysql=microtime(true);
        foreach ($listDevelopers as $devs) {
            $em->remove($devs);
            $em->flush();
        }
        $timeremoveendmysql=microtime(true);
        $timeremovemysql=$timeremoveendmysql-$timeremovestartmysql;

        //INSERT MONGO
        $timestartmongoinsert=microtime(true);
        $cptdev = 0;
        while ($cptdev < 50) {
            $buildermongo = new DevBuilder();
            $devmongo =  $buildermongo->buildDevMongoDB();

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($devmongo );
            $dm->flush();

            $cptdev++;
        }
        $timeendmongoinsert=microtime(true);
        $timeinsertmongo=$timeendmongoinsert-$timestartmongoinsert;

        //SELECT* MONGO
        $timeselectstartmongo=microtime(true);
        $cptdeva = 0;
        while ($cptdeva < 50) {
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');
        $listDevs = $repositoryy->findIn2017();
        $cptdeva++;
        }
        $timeselectendmongo=microtime(true);
        $timeselectmongo=$timeselectendmongo-$timeselectstartmongo;

        //REMOVE MONGO
        $timeremovestartmongo=microtime(true);
        foreach ($listDevs as $devvs) {
            $dm->remove($devvs);
            $dm->flush();
        }
        $timeremoveendmongo=microtime(true);
        $timeremovemongo=$timeremoveendmongo-$timeremovestartmongo;


        return $this->render('HDWMainBundle:Main:added.html.twig', array(
            'timeinsertmysql' => $timeinsertmysql,
            'timeinsertmongo' => $timeinsertmongo,
            'timeselectmysql' => $timeselectmysql,
            'timeselectmongo' => $timeselectmongo,
            'timeremovemysql' => $timeremovemysql,
            'timeremovemongo' => $timeremovemongo));
    }
}