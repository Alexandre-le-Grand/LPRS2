<?php

namespace App\Entity;

use App\Repository\LinkEtudiantOffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkEtudiantOffreRepository::class)]
class LinkEtudiantOffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'linkEtudiantOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $ref_offre = null;

    #[ORM\ManyToOne(inversedBy: 'linkEtudiantOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $ref_etudiant = null;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRefOffre(): ?Offre
    {
        return $this->ref_offre;
    }

    public function setRefOffre(?Offre $ref_offre): static
    {
        $this->ref_offre = $ref_offre;

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
