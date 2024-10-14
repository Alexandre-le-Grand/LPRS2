<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreOffre = null;

    #[ORM\Column(length: 2048)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOffre = null;

    #[ORM\Column(length: 255)]
    private ?string $etatOffre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $ref_entreprise = null;

    /**
     * @var Collection<int, LinkEtudiantOffre>
     */
    #[ORM\OneToMany(targetEntity: LinkEtudiantOffre::class, mappedBy: 'ref_offre', orphanRemoval: true)]
    private Collection $linkEtudiantOffres;

    public function __construct()
    {
        $this->linkEtudiantOffres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreOffre(): ?string
    {
        return $this->titreOffre;
    }

    public function setTitreOffre(string $titreOffre): static
    {
        $this->titreOffre = $titreOffre;

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

    public function getTypeOffre(): ?string
    {
        return $this->typeOffre;
    }

    public function setTypeOffre(string $typeOffre): static
    {
        $this->typeOffre = $typeOffre;

        return $this;
    }

    public function getEtatOffre(): ?string
    {
        return $this->etatOffre;
    }

    public function setEtatOffre(string $etatOffre): static
    {
        $this->etatOffre = $etatOffre;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

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
            $linkEtudiantOffre->setRefOffre($this);
        }

        return $this;
    }

    public function removeLinkEtudiantOffre(LinkEtudiantOffre $linkEtudiantOffre): static
    {
        if ($this->linkEtudiantOffres->removeElement($linkEtudiantOffre)) {
            // set the owning side to null (unless already changed)
            if ($linkEtudiantOffre->getRefOffre() === $this) {
                $linkEtudiantOffre->setRefOffre(null);
            }
        }

        return $this;
    }
}
