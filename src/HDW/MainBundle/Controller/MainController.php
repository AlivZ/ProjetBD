<?php

namespace HDW\MainBundle\Controller;

use HDW\MainBundle\Factory\DevFactory;
use HDW\MongoDBBundle\Document\address;
use HDW\MongoDBBundle\Document\Ville;
use HDW\MongoDBBundle\Document\classe;
use HDW\MongoDBBundle\Document\datenaissance;
use HDW\MongoDBBundle\Document\Dev;
use HDW\MongoDBBundle\Document\Etudiant;
use HDW\MongoDBBundle\Document\results;
use HDW\MongoDBBundle\Document\student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HDWMainBundle:Main:index.html.twig');
    }

    public function insertAction() {

        $cptinsertmysql = 0;
        $timeinsertstartmysql=microtime(true);
        while ($cptinsertmysql < 500) {
            $devmysql = DevFactory::createDev("mysql");
            $em = $this->getDoctrine()->getManager();
            $em->persist($devmysql);
            $em->flush();
            $cptinsertmysql++;
        }
        $timeinsertendmysql=microtime(true);
        $timeinsertmysql=$timeinsertendmysql-$timeinsertstartmysql;

        $cptinsertmongo = 0;
        $timeinsertstartmongo=microtime(true);
        while ($cptinsertmongo < 500) {
            $devmongo = DevFactory::createDev("mongodb");
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($devmongo);
            $dm->flush();
            $cptinsertmongo++;
        }
        $timeinsertendmongo=microtime(true);
        $timeinsertmongo=$timeinsertendmongo-$timeinsertstartmongo;

        $series = array(
            array("name" => "MySQL",    "data" => array($timeinsertmysql)),
            array("name" => "MongoDB",    "data" => array($timeinsertmongo))
        );

        $ob = new Highchart();
        $ob->chart->type('column');
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('INSERT');
        $ob->subtitle->text('500 INSERT OK');

        $ob->xAxis->categories(array("INSERT"));
        $ob->xAxis->crosshair(true);

        $ob->yAxis->min(0);
        $ob->yAxis->title(array('text'  => "Secondes (s)"));

        $ob->tooltip->headerFormat('<span style="font-size:10px">{point.key}</span><table>');
        $ob->tooltip->pointFormat('<tr><td style="color:{series.color};padding:0">{series.name}: </td>
            <td style="padding:0"><b>{point.y:.1f} s</b></td></tr>');
        $ob->tooltip->footerFormat('</table>');
        $ob->tooltip->shared(true);
        $ob->tooltip->useHTML(true);

        $ob->plotOptions->column(array("pointPadding"=> 0.2,"borderWidth"=> 0));

        $ob->series($series);

        return $this->render('HDWMainBundle:Main:insert.html.twig', array(
            'chart' => $ob
        ));
    }

    public function removeAction() {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');
        $listDevelopers = $repository->findAll();

        $timeremovestartmysql=microtime(true);
        foreach ($listDevelopers as $devs) {
            $em->remove($devs);
            $em->flush();
        }
        $timeremoveendmysql=microtime(true);
        $timeremovemysql=$timeremoveendmysql-$timeremovestartmysql;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');
        $listDevs = $repositoryy->findAll();

        $timeremovestartmongo=microtime(true);
        foreach ($listDevs as $devvs) {
            $dm->remove($devvs);
            $dm->flush();
        }
        $timeremoveendmongo=microtime(true);
        $timeremovemongo=$timeremoveendmongo-$timeremovestartmongo;

        $series = array(
            array("name" => "MySQL",    "data" => array($timeremovemysql)),
            array("name" => "MongoDB",    "data" => array($timeremovemongo))
        );

        $ob = new Highchart();
        $ob->chart->type('column');
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('REMOVE');
        $ob->subtitle->text('REMOVE OK');

        $ob->xAxis->categories(array("REMOVE"));
        $ob->xAxis->crosshair(true);

        $ob->yAxis->min(0);
        $ob->yAxis->title(array('text'  => "Secondes (s)"));

        $ob->tooltip->headerFormat('<span style="font-size:10px">{point.key}</span><table>');
        $ob->tooltip->pointFormat('<tr><td style="color:{series.color};padding:0">{series.name}: </td>
            <td style="padding:0"><b>{point.y:.1f} s</b></td></tr>');
        $ob->tooltip->footerFormat('</table>');
        $ob->tooltip->shared(true);
        $ob->tooltip->useHTML(true);

        $ob->plotOptions->column(array("pointPadding"=> 0.2,"borderWidth"=> 0));

        $ob->series($series);

        return $this->render('HDWMainBundle:Main:remove.html.twig', array(
            'chart' => $ob
        ));
    }

    public function selectAction() {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');

        $timeselectstartallmysql=microtime(true);
        for ($i = 0; $i < 500; $i++) {
            $listDevelopers = $repository->findAll();
        }
        $timeselectendallmysql=microtime(true);
        $timeselectallmysql=$timeselectendallmysql-$timeselectstartallmysql;

        $timeselectstart2017mysql=microtime(true);
        for ($i = 0; $i < 500; $i++) {
        $list2017 = $repository->findIn2017();
        }
        $timeselectend2017mysql=microtime(true);
        $timeselect2017mysql=$timeselectend2017mysql-$timeselectstart2017mysql;

        $timeselectstartstagemysql=microtime(true);
        for ($i = 0; $i < 500; $i++) {
        $listStagiaires = $repository->findStagiaire();
        }
        $timeselectendstagemysql=microtime(true);
        $timeselectstagemysql=$timeselectendstagemysql-$timeselectstartstagemysql;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');

        $timeselectstartallmongo=microtime(true);
        for ($i = 0; $i < 500; $i++) {
            $listmDevelopers = $repositoryy->findAll();
        }
        $timeselectendallmongo=microtime(true);
        $timeselectallmongo=$timeselectendallmongo-$timeselectstartallmongo;

        $timeselectstart2017mongo=microtime(true);
        for ($i = 0; $i < 500; $i++) {
        $listm2017 = $repositoryy->findIn2017();
        }
        $timeselectend2017mongo=microtime(true);
        $timeselect2017mongo=$timeselectend2017mongo-$timeselectstart2017mongo;

        $timeselectstartstagemongo=microtime(true);
        for ($i = 0; $i < 500; $i++) {
        $listmStagiaires = $repositoryy->findStagiaire();
        }
        $timeselectendstagemongo=microtime(true);
        $timeselectstagemongo=$timeselectendstagemongo-$timeselectstartstagemongo;

        $series = array(
            array("name" => "MySQL",    "data" => array($timeselectallmysql,$timeselect2017mysql,$timeselectstagemysql)),
            array("name" => "MongoDB",    "data" => array($timeselectallmongo,$timeselect2017mongo,$timeselectstagemongo))
        );

        $ob = new Highchart();
        $ob->chart->type('column');
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Comparaison des Bases de Données');
        $ob->subtitle->text('500 Requetes de types SELECT');

        $ob->xAxis->categories(array("SELECT * FROM Dev","SELECT * FROM Dev WHERE Dev.startingdate BETWEEN 2017-01-01 AND 2017-12-31","SELECT * FROM Dev WHERE state = \"Stagiaire\""));
        $ob->xAxis->crosshair(true);

        $ob->yAxis->min(0);
        $ob->yAxis->title(array('text'  => "Secondes (s)"));

        $ob->tooltip->headerFormat('<span style="font-size:10px">{point.key}</span><table>');
        $ob->tooltip->pointFormat('<tr><td style="color:{series.color};padding:0">{series.name}: </td>
            <td style="padding:0"><b>{point.y:.1f} s</b></td></tr>');
        $ob->tooltip->footerFormat('</table>');
        $ob->tooltip->shared(true);
        $ob->tooltip->useHTML(true);

        $ob->plotOptions->column(array("pointPadding"=> 0.2,"borderWidth"=> 0));

        $ob->series($series);

        return $this->render('HDWMainBundle:Main:select.html.twig', array(
            'chart' => $ob
        ));
    }

    public function selectjoinAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('HDWMySQLBundle:Developer');

        $timeselectjoinstartmysql = microtime(true);
        for ($i = 0; $i < 500; $i++) {
            $listDevelopers = $repository->findDevMontpellier();
        }
        $timeselectjoinendmysql = microtime(true);
        $timeselectjoinmysql = $timeselectjoinendmysql - $timeselectjoinstartmysql;


        $dm = $this->get('doctrine_mongodb')->getManager();
        $repositoryy = $this->get('doctrine_mongodb')->getManager()->getRepository('HDWMongoDBBundle:Dev');

        $timeselectjoinstartmongo = microtime(true);
        for ($i = 0; $i < 500; $i++) {
            $listmDevelopers = $repositoryy->findDevMontpellier();
        }
        $timeselectjoinendmongo = microtime(true);
        $timeselectjoinmongo = $timeselectjoinendmongo - $timeselectjoinstartmongo;

        $series = array(
            array("name" => "MySQL", "data" => array($timeselectjoinmysql)),
            array("name" => "MongoDB", "data" => array($timeselectjoinmongo))
        );

        $ob = new Highchart();
        $ob->chart->type('column');
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('SELECT JOIN');
        $ob->subtitle->text('500 SELECT JOIN');

        $ob->xAxis->categories(array("SELECT JOIN"));
        $ob->xAxis->crosshair(true);

        $ob->yAxis->min(0);
        $ob->yAxis->title(array('text' => "Secondes (s)"));

        $ob->tooltip->headerFormat('<span style="font-size:10px">{point.key}</span><table>');
        $ob->tooltip->pointFormat('<tr><td style="color:{series.color};padding:0">{series.name}: </td>
            <td style="padding:0"><b>{point.y:.1f} s</b></td></tr>');
        $ob->tooltip->footerFormat('</table>');
        $ob->tooltip->shared(true);
        $ob->tooltip->useHTML(true);

        $ob->plotOptions->column(array("pointPadding" => 0.2, "borderWidth" => 0));

        $ob->series($series);

        return $this->render('HDWMainBundle:Main:selectjoin.html.twig', array(
            'chart' => $ob
        ));
    }

    public function addAction() {
        $dev = new Dev();
        $dev->setName("Boschatel");
        $dev->setNickname("Valentin");
        $dev->setAge(29);
        $dev->setDbfav("Cassandra");
        $dev->setState("Chef de Projet");

        $devo = new Dev();
        $devo->setName("gfgg");
        $devo->setNickname("dd");
        $devo->setAge(12);
        $devo->setDbfav("SQL");
        $devo->setState("Stagiaire");

        $citydev = new Ville();
        $citydev->setName("Hurlevent");
        $citydev->setCountry("Azeroth");

        $dev->setCity($citydev);
        $devo->setCity($citydev);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($dev);
        $dm->flush();
        $dm->persist($devo);
        $dm->flush();

        return $this->render('HDWMainBundle:Main:index.html.twig');
    }
}