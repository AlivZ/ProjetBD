<?php

namespace HDW\MongoDBBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="HDW\MongoDBBundle\Repository\ProRepository")
 */
class Project
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="date")
    */
    protected $datestart;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $dateend;

    public function __construct()
    {

    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set datestart
     *
     * @param date $datestart
     * @return $this
     */
    public function setDatestart($datestart)
    {
        $this->datestart = $datestart;
        return $this;
    }

    /**
     * Get datestart
     *
     * @return date $datestart
     */
    public function getDatestart()
    {
        return $this->datestart;
    }

    /**
     * Set dateend
     *
     * @param date $dateend
     * @return $this
     */
    public function setDateend($dateend)
    {
        $this->dateend = $dateend;
        return $this;
    }

    /**
     * Get dateend
     *
     * @return date $dateend
     */
    public function getDateend()
    {
        return $this->dateend;
    }
}
