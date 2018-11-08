<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Btw
 *
 * @ORM\Table(name="btw")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\BtwRepository")
 */
class Btw
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
     * @ORM\Column(name="procent", type="decimal", precision=5, scale=2)
     */
    private $procent;


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
     * Set procent
     *
     * @param string $procent
     *
     * @return Btw
     */
    public function setProcent($procent)
    {
        $this->procent = $procent;

        return $this;
    }

    /**
     * Get procent
     *
     * @return string
     */
    public function getProcent()
    {
        return $this->procent;
    }

    public function __toString()
    {
        return $this->procent . "%";
    }
}

