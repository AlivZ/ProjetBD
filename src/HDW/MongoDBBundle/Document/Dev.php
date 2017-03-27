<?php

namespace HDW\MongoDBBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* @MongoDB\Document
*/
class Dev
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
    * @MongoDB\Field(type="string")
    */
    protected $nickname;

    /**
    * @MongoDB\Field(type="integer")
    */
    protected $age;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $state;

    /**
     * @MongoDB\Field(type="string")
     */
      protected $dbfav;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $startingdate;

    public function __construct()
    {
        $this->startingdate = new \Datetime();
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
     * Set nickname
     *
     * @param string $nickname
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string $nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * Get age
     *
     * @return integer $age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set dbfav
     *
     * @param string $dbfav
     * @return $this
     */
    public function setDbfav($dbfav)
    {
        $this->dbfav = $dbfav;
        return $this;
    }

    /**
     * Get dbfav
     *
     * @return string $dbfav
     */
    public function getDbfav()
    {
        return $this->dbfav;
    }

    /**
     * Set startingdate
     *
     * @param date $startingdate
     * @return $this
     */
    public function setStartingdate($startingdate)
    {
        $this->startingdate = $startingdate;
        return $this;
    }

    /**
     * Get startingdate
     *
     * @return date $startingdate
     */
    public function getStartingdate()
    {
        return $this->startingdate;
    }
}
