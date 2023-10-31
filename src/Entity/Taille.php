<?php

namespace App\Entity;

use App\Repository\TailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Robe::class)]
    private Collection $robes;

    public function __construct()
    {
        $this->robes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $robe->setTaille($this);
        }

        return $this;
    }

    public function removeRobe(Robe $robe): static
    {
        if ($this->robes->removeElement($robe)) {
            // set the owning side to null (unless already changed)
            if ($robe->getTaille() === $this) {
                $robe->setTaille(null);
            }
        }

        return $this;
    }
}
