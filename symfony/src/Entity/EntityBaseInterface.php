<?php

namespace AppBundle\Mapping;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

interface EntityBaseInterface
{
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void;

    /**
     * Get createdAt
     *
     * @return null|DateTime
     */
    public function getCreatedAt(): ?DateTime;

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self;
        
    /**
     * Get updatedAt
     *
     * @param DateTime $createdAt
     * @return self
     */
    public function getUpdatedAt(): ?DateTime;

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt): self;
}
