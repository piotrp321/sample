<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Constants\Status;

/**
 * Class StatusTrait
 * @package AppBundle\Entity\Traits
 */
trait StatusTrait
{
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string",
     *     columnDefinition="ENUM('ACTIVE', 'INACTIVE')",
     *     options={"default"= "ACTIVE"}
     * )
     */
    protected $status = Status::ACTIVE;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function outputStatus()
    {
        $statuses = Status::getStatuses();

        return $statuses[$this->getStatus()] ?? ' - ';
    }
}