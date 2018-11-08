<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Factuur
 *
 * @ORM\Table(name="factuur")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\FactuurRepository")
 */
class Factuur
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="customerId", referencedColumnName="id")
     */

    private $customerId;

    /**
     * @var string
     *
     * @ORM\Column(name="opmerking", type="string", length=255)
     */
    private $opmerking;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="date")
     */
    private $timestamp;

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="betaald", type="integer", length=255)
     */
    private $betaald;

    /**
     * @return mixed
     */
    public function getBetaald()
    {
        return $this->betaald;
    }

    /**
     * @param mixed $betaald
     */
    public function setBetaald($betaald)
    {
        $this->betaald = $betaald;
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
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return Factuur
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set opmerking
     *
     * @param string $opmerking
     *
     * @return Factuur
     */
    public function setOpmerking($opmerking)
    {
        $this->opmerking = $opmerking;

        return $this;
    }

    /**
     * Get opmerking
     *
     * @return string
     */
    public function getOpmerking()
    {
        return $this->opmerking;
    }


    public function __toString()
    {
        return $this->getId() . '';
    }

    public function __construct()
    {
        $this->timestamp = new \DateTime("now");
    }
}

