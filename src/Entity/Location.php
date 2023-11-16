<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    use TimestampableEntity;
    use SoftDeleteableEntity;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutLocation = null;

    #[Assert\GreaterThan(propertyPath: 'dateDebutLocation')]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFinLocation = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixTotal = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Robe::class, mappedBy: 'locations')]
    private Collection $robes;

    public function __construct()
    {
        $this->robes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutLocation(): ?\DateTimeInterface
    {
        return $this->dateDebutLocation;
    }

    public function setDateDebutLocation(\DateTimeInterface $dateDebutLocation): static
    {
        $this->dateDebutLocation = $dateDebutLocation;

        return $this;
    }

    public function getDateFinLocation(): ?\DateTimeInterface
    {
        return $this->dateFinLocation;
    }

    public function setDateFinLocation(?\DateTimeInterface $dateFinLocation): static
    {
        $this->dateFinLocation = $dateFinLocation;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(?float $prixTotal): static
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Robe>
     */
    public function getRobes(): Collection
    {
        return $this->robes;
    }
    public function addRobe(Robe $robe): static
    {
        if (!$this->robes->contains($robe)) {
            $this->robes->add($robe);
            $robe->addLocation($this);
        }

        return $this;
    }
    public function removeRobe(Robe $robe): static
    {
        if ($this->robes->removeElement($robe)) {
            $robe->removeLocation($this);
        }

        return $this;
    }
    public function __toString()
    {
        $robes = $this->getRobes();
        $robesNames = [];

        foreach($robes as $robe)
        {
            $robesNames[] = $robe->getNomRobe();
        }
        return implode(', ', $robesNames);
    }
}
