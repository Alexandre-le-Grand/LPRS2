<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $poste_entreprise = null;

    #[ORM\Column(type: Types::BLOB)]
    private $fiche_entreprise;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_utilisateur = null;

    /**
     * @var Collection<int, Evenement>
     */
    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'ref_entreprise', orphanRemoval: true)]
    private Collection $evenements;

    /**
     * @var Collection<int, Offre>
     */
    #[ORM\OneToMany(targetEntity: Offre::class, mappedBy: 'ref_entreprise', orphanRemoval: true)]
    private Collection $offres;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->offres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosteEntreprise(): ?string
    {
        return $this->poste_entreprise;
    }

    public function setPosteEntreprise(string $poste_entreprise): static
    {
        $this->poste_entreprise = $poste_entreprise;

        return $this;
    }

    public function getFicheEntreprise()
    {
        return $this->fiche_entreprise;
    }

    public function setFicheEntreprise($fiche_entreprise): static
    {
        $this->fiche_entreprise = $fiche_entreprise;

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
            $evenement->setRefEntreprise($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getRefEntreprise() === $this) {
                $evenement->setRefEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): static
    {
        if (!$this->offres->contains($offre)) {
            $this->offres->add($offre);
            $offre->setRefEntreprise($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): static
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getRefEntreprise() === $this) {
                $offre->setRefEntreprise(null);
            }
        }

        return $this;
    }
}
