<?php

namespace App\Entity;

use App\Repository\AlumniRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumniRepository::class)]
class Alumni
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

    #[ORM\ManyToOne(inversedBy: 'alumnis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $ref_etudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getRefEtudiant(): ?Etudiant
    {
        return $this->ref_etudiant;
    }

    public function setRefEtudiant(?Etudiant $ref_etudiant): static
    {
        $this->ref_etudiant = $ref_etudiant;

        return $this;
    }
}
