<?php

namespace App\Entity;

use App\Repository\QuotationServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuotationServiceRepository::class)
 */
class QuotationService
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="quotation")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity=Quotation::class, inversedBy="quotationServices")
     */
    private $quotation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getQuotation(): ?Quotation
    {
        return $this->quotation;
    }

    public function setQuotation(?Quotation $quotation): self
    {
        $this->quotation = $quotation;

        return $this;
    }
}
