<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Model\Product;
use AppBundle\Constants\Sleeve;

/**
 * Shirt
 *
 * @ORM\Table(name="shirt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShirtRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Shirt extends Product
{

    /**
     * @var string $sleeve
     *
     * @ORM\Column(name="sleeve", type="string",
     *     columnDefinition="ENUM('LONG', 'SHORT')",
     *     options={"default"= "LONG"}
     * )
     */
    protected $sleeve = Sleeve::LONG;

    /**
     * @return string
     */
    public function getSleeve()
    {
        return $this->sleeve;
    }

    /**
     * @param $sleeve
     * @return $this
     */
    public function setSleeve($sleeve)
    {
        $this->sleeve = $sleeve;

        return $this;
    }

    /**
     * @return string
     */
    public function outputSleeve()
    {
        $sleeves = Sleeve::getSleeves();

        return $sleeves[$this->getSleeve()] ?? ' - ';
    }

}

