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

    public function wowAction()
    {
        //INSERT MYSQL
        $timeinsertstartmysql=microtime(true);
        $cptdevv = 0;
        while ($cptdevv < 900) {

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
        while ($cptdevo < 900) {
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
        while ($cptdev < 900) {
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
        while ($cptdeva < 900) {
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

    public function insertAction() {
        $cptinsert = 0;
        while ($cptinsert < 500) {
            $buildermysql = new DevBuilder();
            $devmysql = $buildermysql->buildDevMySQL();

            $em = $this->getDoctrine()->getManager();
            $em->persist($devmysql);
            $em->flush();

            $buildermongo = new DevBuilder();
            $devmongo = $buildermongo->buildDevMongoDB();

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($devmongo);
            $dm->flush();

            $cptinsert++;
        }

        return $this->render('HDWMainBundle:Main:insert.html.twig');
    }

    public function removeAction() {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');
        $listDevelopers = $repository->findAll();
        foreach ($listDevelopers as $devs) {
            $em->remove($devs);
            $em->flush();
        }

        $dm = $this->get('doctrine_mongodb')->getManager();
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');
        $listDevs = $repositoryy->findAll();
        foreach ($listDevs as $devvs) {
            $dm->remove($devvs);
            $dm->flush();
        }

        return $this->render('HDWMainBundle:Main:remove.html.twig');
    }

    public function selectAction() {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');

        $timeselectstartallmysql=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
            $listDevelopers = $repository->findAll();
        }
        $timeselectendallmysql=microtime(true);
        $timeselectallmysql=$timeselectendallmysql-$timeselectstartallmysql;

        $timeselectstart2017mysql=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
        $list2017 = $repository->findIn2017();
        }
        $timeselectend2017mysql=microtime(true);
        $timeselect2017mysql=$timeselectend2017mysql-$timeselectstart2017mysql;

        $timeselectstartstagemysql=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
        $listStagiaires = $repository->findStagiaire();
        }
        $timeselectendstagemysql=microtime(true);
        $timeselectstagemysql=$timeselectendstagemysql-$timeselectstartstagemysql;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');

        $timeselectstartallmongo=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
            $listmDevelopers = $repositoryy->findAll();
        }
        $timeselectendallmongo=microtime(true);
        $timeselectallmongo=$timeselectendallmongo-$timeselectstartallmongo;

        $timeselectstart2017mongo=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
        $listm2017 = $repositoryy->findIn2017();
        }
        $timeselectend2017mongo=microtime(true);
        $timeselect2017mongo=$timeselectend2017mongo-$timeselectstart2017mongo;

        $timeselectstartstagemongo=microtime(true);
        for ($i = 0; $i < 1000; $i++) {
        $listmStagiaires = $repositoryy->findStagiaire();
        }
        $timeselectendstagemongo=microtime(true);
        $timeselectstagemongo=$timeselectendstagemongo-$timeselectstartstagemongo;

        return $this->render('HDWMainBundle:Main:select.html.twig', array(
            'timeselectallmysql' => $timeselectallmysql,
            'timeselectallmongo' => $timeselectallmongo,
            'timeselect2017mysql' => $timeselect2017mysql,
            'timeselect2017mongo' => $timeselect2017mongo,
            'timeselectstagemysql' => $timeselectstagemysql,
            'timeselectstagemongo' => $timeselectstagemongo,));
    }
}