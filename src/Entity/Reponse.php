<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;


#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    // Yacine
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2048)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_reponse = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $ref_post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateHeureReponse(): ?\DateTimeInterface
    {
        return $this->date_heure_reponse;
    }

    public function setDateHeureReponse(\DateTimeInterface $date_heure_reponse): static
    {
        $this->date_heure_reponse = $date_heure_reponse;

        return $this;
    }

    public function getRefPost(): ?Post
    {
        return $this->ref_post;
    }

    public function setRefPost(?Post $ref_post): static
    {
        $this->ref_post = $ref_post;

        return $this;
    }
    public function getRefUtilisateur(): ?User
    {
        return $this->refUtilisateur;
    }

    public function setRefUtilisateur(?User $refUtilisateur): self
    {
        $this->refUtilisateur = $refUtilisateur;

        return $this;
    }
}
