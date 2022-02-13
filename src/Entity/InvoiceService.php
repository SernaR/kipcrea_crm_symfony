<?php

namespace App\Entity;

use App\Repository\InvoiceServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceServiceRepository::class)
 */
class InvoiceService
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
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="invoiceServices")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceServices")
     */
    private $invoice;

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

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }
}
