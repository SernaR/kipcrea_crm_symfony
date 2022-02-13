<?php

namespace App\Entity;

use App\Repository\QuotationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuotationRepository::class)
 */
class Quotation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sending_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $cancel_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $validation_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discount;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="quotations")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=QuotationService::class, mappedBy="quotation")
     */
    private $quotationServices;

    public function __construct()
    {
        $this->quotationServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCancelDate(): ?\DateTimeInterface
    {
        return $this->cancel_date;
    }

    public function setCancelDate(?\DateTimeInterface $cancel_date): self
    {
        $this->cancel_date = $cancel_date;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validation_date;
    }

    public function setValidationDate(?\DateTimeInterface $validation_date): self
    {
        $this->validation_date = $validation_date;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|QuotationService[]
     */
    public function getQuotationServices(): Collection
    {
        return $this->quotationServices;
    }

    public function addQuotationService(QuotationService $quotationService): self
    {
        if (!$this->quotationServices->contains($quotationService)) {
            $this->quotationServices[] = $quotationService;
            $quotationService->setQuotation($this);
        }

        return $this;
    }

    public function removeQuotationService(QuotationService $quotationService): self
    {
        if ($this->quotationServices->removeElement($quotationService)) {
            // set the owning side to null (unless already changed)
            if ($quotationService->getQuotation() === $this) {
                $quotationService->setQuotation(null);
            }
        }

        return $this;
    }
}
