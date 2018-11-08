<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product_history
 *
 * @ORM\Table(name="product_history")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\Product_historyRepository")
 */
class Product_history
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
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Factuur")
     * @ORM\JoinColumn(name="factuurId", referencedColumnName="id")
     */
    private $factuurId;

    /**
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Artikel")
     * @ORM\JoinColumn(name="artikelId", referencedColumnName="id")
     */
    private $artikelId;

    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="float", nullable=true)
     */
    private $aantal;


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
     * Set factuurId
     *
     * @param integer $factuurId
     *
     * @return Product_history
     */
    public function setFactuurId($factuurId)
    {
        $this->factuurId = $factuurId;

        return $this;
    }

    /**
     * Get factuurId
     *
     * @return int
     */
    public function getFactuurId()
    {
        return $this->factuurId;
    }

    /**
     * Set artikelId
     *
     * @param integer $artikelId
     *
     * @return Product_history
     */
    public function setArtikelId($artikelId)
    {
        $this->artikelId = $artikelId;

        return $this;
    }

    /**
     * Get artikelId
     *
     * @return int
     */
    public function getArtikelId()
    {
        return $this->artikelId;
    }

    /**
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return Product_history
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
    }

    public function __toString()
    {
        return $this->factuurId;
    }
}

