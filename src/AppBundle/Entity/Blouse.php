<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Model\Product;

/**
 * Blouse
 *
 * @ORM\Table(name="blouse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlouseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Blouse extends Product
{
    /**
     * @var bool
     *
     * @ORM\Column(name="hood", type="boolean")
     */
    private $hood;

    /**
     * Set hood
     *
     * @param boolean $hood
     *
     * @return Blouse
     */
    public function setHood($hood)
    {
        $this->hood = $hood;

        return $this;
    }

    /**
     * Get hood
     *
     * @return bool
     */
    public function getHood()
    {
        return $this->hood;
    }
}

