<?php

namespace HDW\MongoDBBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use HDW\MainBundle\Repository\I_DeveloperRepository;

/**
 * DevRepository
 *
 * This class was generated by the Doctrine ODM. Add your own custom
 * repository methods below.
 */
class DevRepository extends DocumentRepository implements I_DeveloperRepository
{
    public function findIn2017()
    {
        $starttime = new \MongoDate(strtotime('2017-01-01 00:00:00'));
        $endtime = new \MongoDate(strtotime('2017-12-31 00:00:00'));
       return $this->createQueryBuilder('Dev')
           ->field('startingdate')->range($starttime,$endtime)
           ->getQuery()
           ->execute()
           ;
    }

    public function findStagiaire()
    {
        return $this->createQueryBuilder('Dev')->field('state')->equals('Stagiaire')
            ->getQuery()->execute();
    }
}
