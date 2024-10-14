<?php

namespace App\Entity;

use App\Repository\LinkEtudiantEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkEtudiantEvenementRepository::class)]
class LinkEtudiantEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'linkEtudiantEvenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?etudiant $ref_etudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefEtudiant(): ?etudiant
    {
        return $this->ref_etudiant;
    }

    public function setRefEtudiant(?etudiant $ref_etudiant): static
    {
        $this->ref_etudiant = $ref_etudiant;

        return $this;
    }
}
