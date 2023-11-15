<?php

namespace App\Entity;

use App\Repository\RetoucheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: RetoucheRepository::class)]
class Retouche
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\GreaterThan(propertyPath: 'dateRetouche')]
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

    public function __toString()
    {
        return "{$this->getDateRetouche()} {$this->getDateFinRetouche()}";
    }
}
