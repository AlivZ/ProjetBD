<?php
/**
 * Created by PhpStorm.
 * User: hugod
 * Date: 03/04/2017
 * Time: 09:58
 */

namespace HDW\MySQLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="developerprojet")
 */
class DeveloperProjet
{
    /**
     * @ORM\ManyToOne(targetEntity="HDW\MySQLBundle\Entity\Developer")
     * @ORM\Id
     * @ORM\JoinColumn(nullable=false)
     */
    private $developer;

    /**
     * @ORM\ManyToOne(targetEntity="HDW\MySQLBundle\Entity\Projet")
     * @ORM\Id
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    public function __construct($pro, $dev)
    {
        $this->developer = $dev;
        $this->projet = $pro;
    }

    /**
     * Set developer
     *
     * @param \HDW\MySQLBundle\Entity\Developer $developer
     *
     * @return DeveloperProjet
     */
    public function setDeveloper(\HDW\MySQLBundle\Entity\Developer $developer)
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Get developer
     *
     * @return \HDW\MySQLBundle\Entity\Developer
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * Set projet
     *
     * @param \HDW\MySQLBundle\Entity\Projet $projet
     *
     * @return DeveloperProjet
     */
    public function setProjet(\HDW\MySQLBundle\Entity\Projet $projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \HDW\MySQLBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
