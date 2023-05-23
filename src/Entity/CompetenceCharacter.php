<?php

namespace App\Entity;

use App\Repository\CompetenceCharacterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceCharacterRepository::class)]
class CompetenceCharacter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'competenceCharacters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Character $perso = null;

    #[ORM\ManyToOne(inversedBy: 'competenceCharacters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competence $competence = null;

    #[ORM\ManyToOne(inversedBy: 'competenceCharacters')]
    private ?Session $session = null;

    #[ORM\Column(nullable: true)]
    private ?float $valueCompetence = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
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

    public function getValueCompetence(): ?float
    {
        return $this->valueCompetence;
    }

    public function setValueCompetence(?float $valueCompetence): self
    {
        $this->valueCompetence = $valueCompetence;

        return $this;
    }
}
