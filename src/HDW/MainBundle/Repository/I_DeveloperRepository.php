<?php

namespace HDW\MainBundle\Repository;
/**
 * Created by PhpStorm.
 * User: hugod
 * Date: 29/03/2017
 * Time: 11:23
 */
interface I_DeveloperRepository
{
    public function findIn2017();
    public function findStagiaire();
    public function findDevMontpellier();
    public function findProjetsDev();
}