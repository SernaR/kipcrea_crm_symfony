<?php

namespace App\Entity;

use App\Repository\TrackingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrackingRepository::class)
 */
class Tracking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Invoice::class, inversedBy="isLicence", cascade={"persist", "remove"})
     */
    private $invoice;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isLicence;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isCopyright;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isAnnualMaintenance;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isMonthlyMaintenance;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isSettle;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsLicence(): ?bool
    {
        return $this->isLicence;
    }

    public function setIsLicence(bool $isLicence): self
    {
        $this->isLicence = $isLicence;

        return $this;
    }

    public function getIsCopyright(): ?bool
    {
        return $this->isCopyright;
    }

    public function setIsCopyright(bool $isCopyright): self
    {
        $this->isCopyright = $isCopyright;

        return $this;
    }

    public function getIsAnnualMaintenance(): ?bool
    {
        return $this->isAnnualMaintenance;
    }

    public function setIsAnnualMaintenance(bool $isAnnualMaintenance): self
    {
        $this->isAnnualMaintenance = $isAnnualMaintenance;

        return $this;
    }

    public function getIsMonthlyMaintenance(): ?bool
    {
        return $this->isMonthlyMaintenance;
    }

    public function setIsMonthlyMaintenance(bool $isMonthlyMaintenance): self
    {
        $this->isMonthlyMaintenance = $isMonthlyMaintenance;

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
}
