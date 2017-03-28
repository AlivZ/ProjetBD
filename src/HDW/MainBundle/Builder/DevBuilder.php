<?php
/**
 * Created by PhpStorm.
 * User: hugod
 * Date: 28/03/2017
 * Time: 10:59
 */

namespace HDW\MainBundle\Builder;

use HDW\MySQLBundle\Entity\Developer;
use HDW\MongoDBBundle\Document\Dev;


class DevBuilder
{
    public function buildDevMySQL () {
        $dev = new Developer();
        $dev->setName('De Wispelaere');
        $dev->setNickname('Hugo');
        $dev->setAge(23);
        $dev->setState('Stagiaire');
        $dev->setDbfav('MySQL');

        return $dev;
    }

    public function buildDevMongoDB () {
        $dev = new Dev();
        $dev->setName('De Wispelaere');
        $dev->setNickname('Hugo');
        $dev->setAge(23);
        $dev->setState('Stagiaire');
        $dev->setDbfav('MongoDB');

        return $dev;
    }
}