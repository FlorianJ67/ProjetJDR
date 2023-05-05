<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'session')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CharacterStats $characterStats = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCharacterStats(): ?CharacterStats
    {
        return $this->characterStats;
    }

    public function setCharacterStats(?CharacterStats $characterStats): self
    {
        $this->characterStats = $characterStats;

        return $this;
    }
}
