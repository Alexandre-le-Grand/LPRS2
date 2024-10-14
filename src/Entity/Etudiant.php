<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $anneePromo = null;

    #[ORM\Column(type: Types::BLOB)]
    private $cv;

    #[ORM\Column(length: 255)]
    private ?string $poste_entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_utilisateur = null;

    /**
     * @var Collection<int, Alumni>
     */
    #[ORM\OneToMany(targetEntity: Alumni::class, mappedBy: 'ref_etudiant', orphanRemoval: true)]
    private Collection $alumnis;

    /**
     * @var Collection<int, LinkEtudiantOffre>
     */
    #[ORM\OneToMany(targetEntity: LinkEtudiantOffre::class, mappedBy: 'ref_etudiant', orphanRemoval: true)]
    private Collection $linkEtudiantOffres;

    /**
     * @var Collection<int, LinkEtudiantEvenement>
     */
    #[ORM\OneToMany(targetEntity: LinkEtudiantEvenement::class, mappedBy: 'ref_etudiant', orphanRemoval: true)]
    private Collection $linkEtudiantEvenements;

    public function __construct()
    {
        $this->alumnis = new ArrayCollection();
        $this->linkEtudiantOffres = new ArrayCollection();
        $this->linkEtudiantEvenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneePromo(): ?\DateTimeInterface
    {
        return $this->anneePromo;
    }

    public function setAnneePromo(\DateTimeInterface $anneePromo): static
    {
        $this->anneePromo = $anneePromo;

        return $this;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function setCv($cv): static
    {
        $this->cv = $cv;

        return $this;
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
     * @return Collection<int, Alumni>
     */
    public function getAlumnis(): Collection
    {
        return $this->alumnis;
    }

    public function addAlumni(Alumni $alumni): static
    {
        if (!$this->alumnis->contains($alumni)) {
            $this->alumnis->add($alumni);
            $alumni->setRefEtudiant($this);
        }

        return $this;
    }

    public function removeAlumni(Alumni $alumni): static
    {
        if ($this->alumnis->removeElement($alumni)) {
            // set the owning side to null (unless already changed)
            if ($alumni->getRefEtudiant() === $this) {
                $alumni->setRefEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LinkEtudiantOffre>
     */
    public function getLinkEtudiantOffres(): Collection
    {
        return $this->linkEtudiantOffres;
    }

    public function addLinkEtudiantOffre(LinkEtudiantOffre $linkEtudiantOffre): static
    {
        if (!$this->linkEtudiantOffres->contains($linkEtudiantOffre)) {
            $this->linkEtudiantOffres->add($linkEtudiantOffre);
            $linkEtudiantOffre->setRefEtudiant($this);
        }

        return $this;
    }

    public function removeLinkEtudiantOffre(LinkEtudiantOffre $linkEtudiantOffre): static
    {
        if ($this->linkEtudiantOffres->removeElement($linkEtudiantOffre)) {
            // set the owning side to null (unless already changed)
            if ($linkEtudiantOffre->getRefEtudiant() === $this) {
                $linkEtudiantOffre->setRefEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LinkEtudiantEvenement>
     */
    public function getLinkEtudiantEvenements(): Collection
    {
        return $this->linkEtudiantEvenements;
    }

    public function addLinkEtudiantEvenement(LinkEtudiantEvenement $linkEtudiantEvenement): static
    {
        if (!$this->linkEtudiantEvenements->contains($linkEtudiantEvenement)) {
            $this->linkEtudiantEvenements->add($linkEtudiantEvenement);
            $linkEtudiantEvenement->setRefEtudiant($this);
        }

        return $this;
    }

    public function removeLinkEtudiantEvenement(LinkEtudiantEvenement $linkEtudiantEvenement): static
    {
        if ($this->linkEtudiantEvenements->removeElement($linkEtudiantEvenement)) {
            // set the owning side to null (unless already changed)
            if ($linkEtudiantEvenement->getRefEtudiant() === $this) {
                $linkEtudiantEvenement->setRefEtudiant(null);
            }
        }

        return $this;
    }
}
