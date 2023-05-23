<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $competenceValue = null;

    #[ORM\ManyToMany(targetEntity: LienCompetenceCaracteristique::class, mappedBy: 'competence')]
    private Collection $lienCompetenceCaracteristiques;

    public function __construct()
    {
        $this->lienCompetenceCaracteristiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompetenceValue(): ?float
    {
        return $this->competenceValue;
    }

    public function setCompetenceValue(?float $competenceValue): self
    {
        $this->competenceValue = $competenceValue;

        return $this;
    }

    /**
     * @return Collection<int, LienCompetenceCaracteristique>
     */
    public function getLienCompetenceCaracteristiques(): Collection
    {
        return $this->lienCompetenceCaracteristiques;
    }

    public function addLienCompetenceCaracteristique(LienCompetenceCaracteristique $lienCompetenceCaracteristique): self
    {
        if (!$this->lienCompetenceCaracteristiques->contains($lienCompetenceCaracteristique)) {
            $this->lienCompetenceCaracteristiques->add($lienCompetenceCaracteristique);
            $lienCompetenceCaracteristique->addCompetence($this);
        }

        return $this;
    }

    public function removeLienCompetenceCaracteristique(LienCompetenceCaracteristique $lienCompetenceCaracteristique): self
    {
        if ($this->lienCompetenceCaracteristiques->removeElement($lienCompetenceCaracteristique)) {
            $lienCompetenceCaracteristique->removeCompetence($this);
        }

        return $this;
    }
}
