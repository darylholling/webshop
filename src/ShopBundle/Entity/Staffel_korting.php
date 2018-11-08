<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Staffel_korting
 *
 * @ORM\Table(name="staffel_korting")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\Staffel_kortingRepository")
 */
class Staffel_korting
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
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Staffel_groups")
     * @ORM\JoinColumn(name="staffelGroupsId", referencedColumnName="id")
     */
    private $staffelGroupsId;

    /**
     * @var string
     *
     * @ORM\Column(name="min_aantal", type="string", length=255)
     */
    private $minAantal;

    /**
     * @var string
     *
     * @ORM\Column(name="max_aantal", type="string", length=255)
     */
    private $maxAantal;

    /**
     * @var string
     *
     * @ORM\Column(name="korting", type="string", length=255)
     */
    private $korting;


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
     * Set staffelGroupsId
     *
     * @param integer $staffelGroupsId
     *
     * @return Staffel_korting
     */
    public function setStaffelGroupsId($staffelGroupsId)
    {
        $this->staffelGroupsId = $staffelGroupsId;

        return $this;
    }

    /**
     * Get staffelGroupsId
     *
     * @return int
     */
    public function getStaffelGroupsId()
    {
        return $this->staffelGroupsId;
    }

    /**
     * Set minAantal
     *
     * @param string $minAantal
     *
     * @return Staffel_korting
     */
    public function setMinAantal($minAantal)
    {
        $this->minAantal = $minAantal;

        return $this;
    }

    /**
     * Get minAantal
     *
     * @return string
     */
    public function getMinAantal()
    {
        return $this->minAantal;
    }

    /**
     * Set maxAantal
     *
     * @param string $maxAantal
     *
     * @return Staffel_korting
     */
    public function setMaxAantal($maxAantal)
    {
        $this->maxAantal = $maxAantal;

        return $this;
    }

    /**
     * Get maxAantal
     *
     * @return string
     */
    public function getMaxAantal()
    {
        return $this->maxAantal;
    }

    /**
     * Set korting
     *
     * @param string $korting
     *
     * @return Staffel_korting
     */
    public function setKorting($korting)
    {
        $this->korting = $korting;

        return $this;
    }

    /**
     * Get korting
     *
     * @return string
     */
    public function getKorting()
    {
        return $this->korting;
    }
}

