<?php

namespace App\Entity;

use App\Repository\PassagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassagerRepository::class)]
class Passager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $postnom = null;

    #[ORM\Column(length: 50)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuNaissance = null;

    #[ORM\Column(nullable: true)]
    private ?int $phoneNumber = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'nom', targetEntity: Destination::class)]
    private Collection $destinations;

    #[ORM\ManyToMany(targetEntity: TypeVoyage::class, mappedBy: 'nom')]
    private Collection $typeVoyages;

    #[ORM\ManyToMany(targetEntity: DureeSejour::class, mappedBy: 'nom')]
    private Collection $dureeSejours;

    public function __construct() {
        $this->created_at = new \DateTimeImmutable();
        $this->destinations = new ArrayCollection();
        $this->typeVoyages = new ArrayCollection();
        $this->dureeSejours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPostnom(): ?string
    {
        return $this->postnom;
    }

    public function setPostnom(string $postnom): self
    {
        $this->postnom = $postnom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

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

    /**
     * @return Collection<int, Destination>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination): self
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations->add($destination);
            $destination->setNom($this);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            // set the owning side to null (unless already changed)
            if ($destination->getNom() === $this) {
                $destination->setNom(null);
            }
        }

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
            $typeVoyage->addNom($this);
        }

        return $this;
    }

    public function removeTypeVoyage(TypeVoyage $typeVoyage): self
    {
        if ($this->typeVoyages->removeElement($typeVoyage)) {
            $typeVoyage->removeNom($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, DureeSejour>
     */
    public function getDureeSejours(): Collection
    {
        return $this->dureeSejours;
    }

    public function addDureeSejour(DureeSejour $dureeSejour): self
    {
        if (!$this->dureeSejours->contains($dureeSejour)) {
            $this->dureeSejours->add($dureeSejour);
            $dureeSejour->addNom($this);
        }

        return $this;
    }

    public function removeDureeSejour(DureeSejour $dureeSejour): self
    {
        if ($this->dureeSejours->removeElement($dureeSejour)) {
            $dureeSejour->removeNom($this);
        }

        return $this;
    }
}
