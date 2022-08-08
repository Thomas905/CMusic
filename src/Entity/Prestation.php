<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Le prix  est obligatoire.')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le mode de paiement est obligatoire.')]
    private string $paymentmethod;

    #[ORM\Column(type: 'string')]
    private Bool $paymentstatus;

    #[ORM\Column(type: 'text', nullable: true)]
    private $reference;

    #[ORM\ManyToOne(targetEntity: Etablissement::class, inversedBy: 'prestation')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: "L'établissement' est obligatoire.")]
    private $etablissement;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le type de prestation est obligatoire.')]
    private $type;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

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

    public function getPaymentMethod(): ?string
    {
        return $this->paymentmethod;
    }

    public function setPaymentMethod(string $paymentmethod): self
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentstatus;
    }

    public function setPaymentStatus(string $paymentstatus): self
    {
        $this->paymentstatus = $paymentstatus;

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

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function __toString() {
        return $this->payment_methods;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
