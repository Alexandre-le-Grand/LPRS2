<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreEvenement = null;

    #[ORM\Column(length: 2048)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column]
    private ?int $nombrePlaces = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column(length: 255)]
    private ?string $typeEvenement = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $ref_professeur = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $ref_entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreEvenement(): ?string
    {
        return $this->titreEvenement;
    }

    public function setTitreEvenement(string $titreEvenement): static
    {
        $this->titreEvenement = $titreEvenement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNombrePlaces(): ?int
    {
        return $this->nombrePlaces;
    }

    public function setNombrePlaces(int $nombrePlaces): static
    {
        $this->nombrePlaces = $nombrePlaces;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getTypeEvenement(): ?string
    {
        return $this->typeEvenement;
    }

    public function setTypeEvenement(string $typeEvenement): static
    {
        $this->typeEvenement = $typeEvenement;

        return $this;
    }

    public function getRefProfesseur(): ?Professeur
    {
        return $this->ref_professeur;
    }

    public function setRefProfesseur(?Professeur $ref_professeur): static
    {
        $this->ref_professeur = $ref_professeur;

        return $this;
    }

    public function getRefEntreprise(): ?Entreprise
    {
        return $this->ref_entreprise;
    }

    public function setRefEntreprise(?Entreprise $ref_entreprise): static
    {
        $this->ref_entreprise = $ref_entreprise;

        return $this;
    }
}
