<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(
     *      message = "Le prix  est obligatoire.")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *      message = "Le mode de paiement est obligatoire.")
     */
    private string $paymentmethod;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(
     *      message = "Le statut du paiement est obligatoire.")
     */
    private Bool $paymentstatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="prestation")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(
     *      message = "L'établissement' est obligatoire.")
     */
    private $etablissement;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(
     *      message = "La date est obligatoire.")
     *
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *      message = "Le type de prestation est obligatoire.")
     */
    private $type;

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

    public function getPaymentStatus(): ?bool
    {
        return $this->paymentstatus;
    }

    public function setPaymentStatus(bool $paymentstatus): self
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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
}
