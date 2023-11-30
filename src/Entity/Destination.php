<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'destinations')]
    private ?Passager $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_voyage = null;

    #[ORM\ManyToMany(targetEntity: TypeVoyage::class, mappedBy: 'destination')]
    private Collection $typeVoyages;

    public function __construct()
    {
        $this->typeVoyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?Passager
    {
        return $this->nom;
    }

    public function setNom(?Passager $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDateVoyage(): ?\DateTimeInterface
    {
        return $this->date_voyage;
    }

    public function setDateVoyage(\DateTimeInterface $date_voyage): self
    {
        $this->date_voyage = $date_voyage;

        return $this;
    }

    /**
     * @return Collection<int, TypeVoyage>
     */
    public function getTypeVoyages(): Collection
    {
        return $this->typeVoyages;
    }

    public function addTypeVoyage(TypeVoyage $typeVoyage): self
    {
        if (!$this->typeVoyages->contains($typeVoyage)) {
            $this->typeVoyages->add($typeVoyage);
            $typeVoyage->addDestination($this);
        }

        return $this;
    }

    public function removeTypeVoyage(TypeVoyage $typeVoyage): self
    {
        if ($this->typeVoyages->removeElement($typeVoyage)) {
            $typeVoyage->removeDestination($this);
        }

        return $this;
    }
}
