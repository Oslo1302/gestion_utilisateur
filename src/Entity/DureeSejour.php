<?php

namespace App\Entity;

use App\Repository\DureeSejourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DureeSejourRepository::class)]
class DureeSejour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Passager::class, inversedBy: 'dureeSejours')]
    private Collection $nom;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Passager>
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Passager $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom->add($nom);
        }

        return $this;
    }

    public function removeNom(Passager $nom): self
    {
        $this->nom->removeElement($nom);

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
