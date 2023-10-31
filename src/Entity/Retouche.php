<?php

namespace App\Entity;

use App\Repository\RetoucheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetoucheRepository::class)]
class Retouche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRetouche = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFinRetouche = null;

    #[ORM\ManyToOne(inversedBy: 'retouches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Retoucheur $retoucheur = null;

    #[ORM\ManyToOne(inversedBy: 'retouches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Robe $robe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRetouche(): ?\DateTimeInterface
    {
        return $this->dateRetouche;
    }

    public function setDateRetouche(\DateTimeInterface $dateRetouche): static
    {
        $this->dateRetouche = $dateRetouche;

        return $this;
    }

    public function getDateFinRetouche(): ?\DateTimeInterface
    {
        return $this->dateFinRetouche;
    }

    public function setDateFinRetouche(?\DateTimeInterface $dateFinRetouche): static
    {
        $this->dateFinRetouche = $dateFinRetouche;

        return $this;
    }

    public function getRetoucheur(): ?Retoucheur
    {
        return $this->retoucheur;
    }

    public function setRetoucheur(?Retoucheur $retoucheur): static
    {
        $this->retoucheur = $retoucheur;

        return $this;
    }

    public function getRobe(): ?Robe
    {
        return $this->robe;
    }

    public function setRobe(?Robe $robe): static
    {
        $this->robe = $robe;

        return $this;
    }
}