<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $discipline = null;

    #[ORM\Column(length: 255)]
    private ?string $formation = null;

    #[ORM\ManyToOne(inversedBy: 'professeurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_utilisateur = null;

    /**
     * @var Collection<int, Evenement>
     */
    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'ref_professeur', orphanRemoval: true)]
    private Collection $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    public function setDiscipline(string $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getRefUtilisateur(): ?User
    {
        return $this->ref_utilisateur;
    }

    public function setRefUtilisateur(?User $ref_utilisateur): static
    {
        $this->ref_utilisateur = $ref_utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setRefProfesseur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getRefProfesseur() === $this) {
                $evenement->setRefProfesseur(null);
            }
        }

        return $this;
    }
}
