<?php

namespace App\Entity;

use App\Repository\RobeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: RobeRepository::class)]
class Robe
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $nomRobe = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'robes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'robes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'robes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Taille $taille = null;

    #[ORM\ManyToMany(targetEntity: Couleur::class, inversedBy: 'robes')]
    private Collection $couleurs;

    #[ORM\ManyToMany(targetEntity: Location::class, inversedBy: 'robes')]
    private Collection $locations;

    #[ORM\OneToMany(mappedBy: 'robe', targetEntity: Retouche::class)]
    private Collection $retouches;

    public function __construct()
    {
        $this->couleurs = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->retouches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRobe(): ?string
    {
        return $this->nomRobe;
    }

    public function setNomRobe(string $nomRobe): static
    {
        $this->nomRobe = $nomRobe;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Couleur>
     */
    public function getCouleurs(): Collection
    {
        return $this->couleurs;
    }

    public function addCouleur(Couleur $couleur): static
    {
        if (!$this->couleurs->contains($couleur)) {
            $this->couleurs->add($couleur);
        }

        return $this;
    }

    public function removeCouleur(Couleur $couleur): static
    {
        $this->couleurs->removeElement($couleur);

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        $this->locations->removeElement($location);

        return $this;
    }

    /**
     * @return Collection<int, Retouche>
     */
    public function getRetouches(): Collection
    {
        return $this->retouches;
    }

    public function addRetouch(Retouche $retouch): static
    {
        if (!$this->retouches->contains($retouch)) {
            $this->retouches->add($retouch);
            $retouch->setRobe($this);
        }

        return $this;
    }

    public function removeRetouch(Retouche $retouch): static
    {
        if ($this->retouches->removeElement($retouch)) {
            // set the owning side to null (unless already changed)
            if ($retouch->getRobe() === $this) {
                $retouch->setRobe(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return "{$this->getNomRobe()}";

    }
}
