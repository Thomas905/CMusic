<?php

namespace App\Entity;

use App\Repository\EtablisementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtablisementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "L'adresse est obligatoire.")]
    private $adress;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le ville est obligatoire.')]
    private $city;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Le code postal est obligatoire.')]
    private $postalcode;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le nom du contacte est obligatoire.')]
    private $name_contact;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Le téléphone est obligatoire.')]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'adresse mail est obligatoire.")]
    private $email;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank(message: 'La note est obligatoire.')]
    private $note;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Prestation::class)]
    #[Assert\NotBlank(message: 'La prestation est obligatoire.')]
    private $prestation;

    public function __construct()
    {
        $this->prestation = new ArrayCollection();
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
    public function getAdress(): ?string
    {
        return $this->adress;
    }
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
    public function getPostalcode(): ?int
    {
        return $this->postalcode;
    }
    public function setPostalcode(int $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }
    public function getNameContact(): ?string
    {
        return $this->name_contact;
    }
    public function setNameContact(string $name_contact): self
    {
        $this->name_contact = $name_contact;

        return $this;
    }
    public function getPhone(): ?int
    {
        return $this->phone;
    }
    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
    /**
     * @return Collection|Prestation[]
     */
    public function getPrestation(): Collection
    {
        return $this->prestation;
    }
    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestation->contains($prestation)) {
            $this->prestation[] = $prestation;
            $prestation->setEtablissement($this);
        }

        return $this;
    }
    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestation->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getEtablissement() === $this) {
                $prestation->setEtablissement(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->adress;
    }
}
