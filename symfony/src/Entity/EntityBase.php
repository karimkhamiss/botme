<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

class EntityBase implements EntityBaseInterface
{
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new DateTime('now');

        $this->setUpdatedAt($dateTimeNow);

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt(DateTime $createdAt)
    {
        // TODO: Implement setCreatedAt() method.
    }
//    public function setCreatedAt(DateTime $createdAt): self
//    {
//        $this->createdAt = $createdAt;
//
//        return $this;
//    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
