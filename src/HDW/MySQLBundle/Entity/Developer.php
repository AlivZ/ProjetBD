<?php

namespace HDW\MySQLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Developer
 *
 * @ORM\Table(name="developer")
 * @ORM\Entity(repositoryClass="HDW\MySQLBundle\Repository\DeveloperRepository")
 */
class Developer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    private $nickname;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="dbfav", type="string", length=255)
     */
    private $dbfav;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startingdate", type="date")
     */
    private $startingdate;

    public function __construct()
    {

        $this->startingdate = new \Datetime();

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Developer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Developer
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Developer
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Developer
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set dbfav
     *
     * @param string $dbfav
     *
     * @return Developer
     */
    public function setDbfav($dbfav)
    {
        $this->dbfav = $dbfav;

        return $this;
    }

    /**
     * Get dbfav
     *
     * @return string
     */
    public function getDbfav()
    {
        return $this->dbfav;
    }

    /**
     * Set startingdate
     *
     * @param \DateTime $startingdate
     *
     * @return Developer
     */
    public function setStartingdate($startingdate)
    {
        $this->startingdate = $startingdate;

        return $this;
    }

    /**
     * Get startingdate
     *
     * @return \DateTime
     */
    public function getStartingdate()
    {
        return $this->startingdate;
    }
}

