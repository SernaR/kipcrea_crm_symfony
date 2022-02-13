<?php

namespace App\Entity\Traits;

trait AdditionnalPayment {

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sending_date;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sending_date;
    }

    public function setSendingDate(?\DateTimeInterface $sending_date): self
    {
        $this->sending_date = $sending_date;

        return $this;
    }

}