<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureReponse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="reponses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refPost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refUtilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateHeureReponse(): ?\DateTimeInterface
    {
        return $this->dateHeureReponse;
    }

    public function setDateHeureReponse(\DateTimeInterface $dateHeureReponse): self
    {
        $this->dateHeureReponse = $dateHeureReponse;

        return $this;
    }

    public function getRefPost(): ?Post
    {
        return $this->refPost;
    }

    public function setRefPost(?Post $refPost): self
    {
        $this->refPost = $refPost;

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
