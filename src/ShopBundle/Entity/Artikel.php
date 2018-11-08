<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Artikel
 *
 * @ORM\Table(name="artikel")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\ArtikelRepository")
 */
class Artikel
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
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Category")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */

    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Staffel_groups")
     * @ORM\JoinColumn(name="staffelGroupsId", referencedColumnName="id")
     */
    private $staffelGroupsId;

    /**
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Btw")
     * @ORM\JoinColumn(name="btwId", referencedColumnName="id")
     */
    private $btwId;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     */

    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prijs", type="decimal", precision=15, scale=2)
     */
    private $prijs;

    /**
     * @var string
     *
     * @ORM\Column(name="omschrijving", type="text")
     */
    private $omschrijving;

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
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
     * @return Artikel
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
     * Set prijs
     *
     * @param string $prijs
     *
     * @return Artikel
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return string
     */
    public function getPrijs()
    {
        return $this->prijs;
    }

    /**
     * Set staffelGroupsId
     *
     * @param integer $staffelGroupsId
     *
     * @return Artikel
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
     * Set btwId
     *
     * @param integer $btwId
     *
     * @return Artikel
     */
    public function setBtwId($btwId)
    {
        $this->btwId = $btwId;

        return $this;
    }

    /**
     * Get btwId
     *
     * @return int
     */
    public function getBtwId()
    {
        return $this->btwId;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     * @param mixed $omschrijving
     */
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

