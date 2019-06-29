<?php

namespace AppBundle\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    /**
     * @var string $createTime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    protected $createTime;

    /**
     * @var string $updateTime
     *
     * @ORM\Column(name="update_time", type="datetime")
     */
    protected $updateTime;

    /**
     * @return DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @return bool
     */
    public function hasCreateTime()
    {
        return !empty($this->createTime) && $this->createTime->getTimestamp() >= 0;
    }

    /**
     * @param DateTime $createTime
     * @return $this
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param DateTime $updateTime
     * @return $this
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if (!$this->updateTime) {
            $this->updateTime = new \DateTime();
        }
        if (!$this->createTime) {
            $this->createTime = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate()
     */
    public function PreUpdate()
    {
        $this->updateTime = new \DateTime();
    }
}