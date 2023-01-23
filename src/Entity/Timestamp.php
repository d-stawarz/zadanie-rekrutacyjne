<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Timestamp
{
    #[ORM\Column(type: 'datetime', options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(type: 'datetime', options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTime $updatedAt = null;

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }

        $this->updatedAt = new \DateTime();
    }
}