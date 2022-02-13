<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sending_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $delivery_date;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isSettle;

    /**
     * @ORM\OneToOne(targetEntity=Quotation::class, cascade={"persist", "remove"})
     */
    private $quotation;

    /**
     * @ORM\OneToOne(targetEntity=Advance::class, mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $advance;

    /**
     * @ORM\OneToOne(targetEntity=Debit::class, mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $debit;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceService::class, mappedBy="invoice")
     */
    private $invoiceServices;

    /**
     * @ORM\OneToOne(targetEntity=Tracking::class, mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $tracking;

    public function __construct()
    {
        $this->invoiceServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(?\DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    public function getIsSettle(): ?bool
    {
        return $this->isSettle;
    }

    public function setIsSettle(bool $isSettle): self
    {
        $this->isSettle = $isSettle;

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

    public function getAdvance(): ?Advance
    {
        return $this->advance;
    }

    public function setAdvance(?Advance $advance): self
    {
        // unset the owning side of the relation if necessary
        if ($advance === null && $this->advance !== null) {
            $this->advance->setInvoice(null);
        }

        // set the owning side of the relation if necessary
        if ($advance !== null && $advance->getInvoice() !== $this) {
            $advance->setInvoice($this);
        }

        $this->advance = $advance;

        return $this;
    }

    public function getDebit(): ?Debit
    {
        return $this->debit;
    }

    public function setDebit(?Debit $debit): self
    {
        // unset the owning side of the relation if necessary
        if ($debit === null && $this->debit !== null) {
            $this->debit->setInvoice(null);
        }

        // set the owning side of the relation if necessary
        if ($debit !== null && $debit->getInvoice() !== $this) {
            $debit->setInvoice($this);
        }

        $this->debit = $debit;

        return $this;
    }

    /**
     * @return Collection|InvoiceService[]
     */
    public function getInvoiceServices(): Collection
    {
        return $this->invoiceServices;
    }

    public function addInvoiceService(InvoiceService $invoiceService): self
    {
        if (!$this->invoiceServices->contains($invoiceService)) {
            $this->invoiceServices[] = $invoiceService;
            $invoiceService->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceService(InvoiceService $invoiceService): self
    {
        if ($this->invoiceServices->removeElement($invoiceService)) {
            // set the owning side to null (unless already changed)
            if ($invoiceService->getInvoice() === $this) {
                $invoiceService->setInvoice(null);
            }
        }

        return $this;
    }

    public function getTracking(): ?Tracking
    {
        return $this->tracking;
    }

    public function setTracking(?Tracking $tracking): self
    {
        // unset the owning side of the relation if necessary
        if ($tracking === null && $this->tracking !== null) {
            $this->tracking->setInvoice(null);
        }

        // set the owning side of the relation if necessary
        if ($tracking !== null && $tracking->getInvoice() !== $this) {
            $tracking->setInvoice($this);
        }

        $this->tracking = $tracking;

        return $this;
    }
}
