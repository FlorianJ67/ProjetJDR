<?php

namespace App\Entity;

use App\Repository\CaracteristiquePersoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiquePersoRepository::class)]
class CaracteristiquePerso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiquePersos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiquePersos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Caracteristique $caracteristique = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiquePersos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Character $perso = null;

    #[ORM\Column(nullable: true)]
    private ?float $valueCaracteristique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getCaracteristique(): ?Caracteristique
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?Caracteristique $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function getPerso(): ?Character
    {
        return $this->perso;
    }

    public function setPerso(?Character $perso): self
    {
        $this->perso = $perso;

        return $this;
    }

    public function getValueCaracteristique(): ?float
    {
        return $this->valueCaracteristique;
    }

    public function setValueCaracteristique(?float $valueCaracteristique): self
    {
        $this->valueCaracteristique = $valueCaracteristique;

        return $this;
    }
}
