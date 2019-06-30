<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\StatusTrait;
use AppBundle\Entity\Traits\TimestampableTrait;

abstract class Product
{
    const TAX = 23;
    const PRICE_PRECISION = 2;

    use StatusTrait;
    use TimestampableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * Description
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * Quantity
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", options={"default":0})
     */
    protected $quantity;

    /**
     * Price
     * @var float
     *
     * @ORM\Column(name="price", type="float", options={"default":0})
     */
    protected $price;

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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get price with tax
     *
     * @return float
     */
    public final function getPriceWithTax()
    {
        $price = $this->getPrice();
        $tax = $price * self::TAX / 100;
        return round($price + $tax, self::PRICE_PRECISION);
    }
}