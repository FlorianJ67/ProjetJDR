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

    #[ORM\OneToMany(mappedBy: 'competence', targetEntity: CompetenceCharacter::class, orphanRemoval: true)]
    private Collection $competenceCharacters;

    #[ORM\ManyToMany(targetEntity: CollectionCompetence::class, mappedBy: 'competences')]
    private Collection $collectionCompetences;

    public function __construct()
    {
        $this->lienCompetenceCaracteristiques = new ArrayCollection();
        $this->competenceCharacters = new ArrayCollection();
        $this->collectionCompetences = new ArrayCollection();
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

    /**
     * @return Collection<int, CompetenceCharacter>
     */
    public function getCompetenceCharacters(): Collection
    {
        return $this->competenceCharacters;
    }

    public function addCompetenceCharacter(CompetenceCharacter $competenceCharacter): self
    {
        if (!$this->competenceCharacters->contains($competenceCharacter)) {
            $this->competenceCharacters->add($competenceCharacter);
            $competenceCharacter->setCompetence($this);
        }

        return $this;
    }

    public function removeCompetenceCharacter(CompetenceCharacter $competenceCharacter): self
    {
        if ($this->competenceCharacters->removeElement($competenceCharacter)) {
            // set the owning side to null (unless already changed)
            if ($competenceCharacter->getCompetence() === $this) {
                $competenceCharacter->setCompetence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CollectionCompetence>
     */
    public function getCollectionCompetences(): Collection
    {
        return $this->collectionCompetences;
    }

    public function addCollectionCompetence(CollectionCompetence $collectionCompetence): self
    {
        if (!$this->collectionCompetences->contains($collectionCompetence)) {
            $this->collectionCompetences->add($collectionCompetence);
            $collectionCompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeCollectionCompetence(CollectionCompetence $collectionCompetence): self
    {
        if ($this->collectionCompetences->removeElement($collectionCompetence)) {
            $collectionCompetence->removeCompetence($this);
        }

        return $this;
    }
}
