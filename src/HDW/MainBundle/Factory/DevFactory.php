<?php
/**
 * Created by PhpStorm.
 * User: hugod
 * Date: 30/03/2017
 * Time: 10:51
 */

namespace HDW\MainBundle\Factory;


use HDW\MySQLBundle\Entity\City;
use HDW\MySQLBundle\Entity\Developer;
use HDW\MongoDBBundle\Document\Dev;
use HDW\MongoDBBundle\Document\Ville;

class DevFactory
{
    public static function createDev($base){
        $db = NULL;
        if ($base == "mysql")
        {
            $city = new City();
            $city->setName("Montpellier");
            $city->setCountry("FRANCE");
            $db = new Developer();
            $db->setDbfav("MySQL");
            $db->setCity($city);
        }
        if ($base == "mongodb")
        {
            $city = new Ville();
            $city->setName("Montpellier");
            $city->setCountry("FRANCE");
            $db = new Dev();
            $db->setDbfav("MongoDB");
            $db->setVille($city);
        }
        $db->setName("De Wispelaere");
        $db->setNickname("Hugo");
        $db->setAge("23");
        $db->setState("Stagiaire");
        return $db;
    }
}