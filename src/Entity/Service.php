<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isDone;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="services")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=QuotationService::class, mappedBy="service")
     */
    private $quotationServices;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceService::class, mappedBy="service")
     */
    private $invoiceServices;

    public function __construct()
    {
        $this->quotation = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

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
            $quotationService->setService($this);
        }

        return $this;
    }

    public function removeQuotationService(QuotationService $quotationService): self
    {
        if ($this->quotationServices->removeElement($quotationService)) {
            // set the owning side to null (unless already changed)
            if ($quotationService->getService() === $this) {
                $quotationService->setService(null);
            }
        }

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
            $invoiceService->setService($this);
        }

        return $this;
    }

    public function removeInvoiceService(InvoiceService $invoiceService): self
    {
        if ($this->invoiceServices->removeElement($invoiceService)) {
            // set the owning side to null (unless already changed)
            if ($invoiceService->getService() === $this) {
                $invoiceService->setService(null);
            }
        }

        return $this;
    }
}
