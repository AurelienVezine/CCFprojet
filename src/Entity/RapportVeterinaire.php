<?php

namespace App\Entity;

use App\Repository\RapportVeterinaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RapportVeterinaireRepository::class)]
class RapportVeterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $detail = null;

    #[ORM\ManyToOne(inversedBy: 'rapports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'rapportVeterinaires')]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    private ?string $foodoffered = null;

    #[ORM\Column(length: 10)]
    private ?string $foodquantity = null;

    #[ORM\Column(length: 50)]
    private ?string $conditiondetails = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFoodoffered(): ?string
    {
        return $this->foodoffered;
    }

    public function setFoodoffered(string $foodoffered): static
    {
        $this->foodoffered = $foodoffered;

        return $this;
    }

    public function getFoodquantity(): ?string
    {
        return $this->foodquantity;
    }

    public function setFoodquantity(string $foodquantity): static
    {
        $this->foodquantity = $foodquantity;

        return $this;
    }

    public function getConditiondetails(): ?string
    {
        return $this->conditiondetails;
    }

    public function setConditiondetails(string $conditiondetails): static
    {
        $this->conditiondetails = $conditiondetails;

        return $this;
    }
}