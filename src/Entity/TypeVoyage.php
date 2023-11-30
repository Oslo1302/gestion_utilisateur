<?php

namespace App\Entity;

use App\Repository\TypeVoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeVoyageRepository::class)]
class TypeVoyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Passager::class, inversedBy: 'typeVoyages')]
    private Collection $nom;

    #[ORM\ManyToMany(targetEntity: Destination::class, inversedBy: 'typeVoyages')]
    private Collection $destination;

    #[ORM\Column(length: 255)]
    private ?string $type_voyage = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
        $this->destination = new ArrayCollection();
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

    /**
     * @return Collection<int, Destination>
     */
    public function getDestination(): Collection
    {
        return $this->destination;
    }

    public function addDestination(Destination $destination): self
    {
        if (!$this->destination->contains($destination)) {
            $this->destination->add($destination);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): self
    {
        $this->destination->removeElement($destination);

        return $this;
    }

    public function getTypeVoyage(): ?string
    {
        return $this->type_voyage;
    }

    public function setTypeVoyage(string $type_voyage): self
    {
        $this->type_voyage = $type_voyage;

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
