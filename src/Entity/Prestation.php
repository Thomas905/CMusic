<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $paymentmethod;

    /**
     * @ORM\Column(type="boolean")
     */
    private Bool $paymentstatus;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=Etablisement::class, inversedBy="prestation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablisement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentmethod;
    }

    public function setPaymentMethod(string $paymentmethod): self
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    public function getPaymentStatus(): ?bool
    {
        return $this->paymentstatus;
    }

    public function setPaymentStatus(bool $paymentstatus): self
    {
        $this->paymentstatus = $paymentstatus;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getEtablisement(): ?Etablisement
    {
        return $this->etablisement;
    }

    public function setEtablisement(?Etablisement $etablisement): self
    {
        $this->etablisement = $etablisement;

        return $this;
    }

    public function __toString() {
        return $this->payment_methods;
    }
}
