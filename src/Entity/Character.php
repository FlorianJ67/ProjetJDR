<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Item::class, mappedBy: 'inventaire')]
    private Collection $items;

    #[ORM\OneToMany(mappedBy: 'perso', targetEntity: Action::class)]
    private Collection $actions;

    #[ORM\OneToMany(mappedBy: 'perso', targetEntity: CompetenceCharacter::class)]
    private Collection $competenceCharacters;

    #[ORM\OneToMany(mappedBy: 'perso', targetEntity: CaracteristiquePerso::class, orphanRemoval: true)]
    private Collection $caracteristiquePersos;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->competenceCharacters = new ArrayCollection();
        $this->caracteristiquePersos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->addInventaire($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            $item->removeInventaire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->setPerso($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getPerso() === $this) {
                $action->setPerso(null);
            }
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
            $competenceCharacter->setPerso($this);
        }

        return $this;
    }

    public function removeCompetenceCharacter(CompetenceCharacter $competenceCharacter): self
    {
        if ($this->competenceCharacters->removeElement($competenceCharacter)) {
            // set the owning side to null (unless already changed)
            if ($competenceCharacter->getPerso() === $this) {
                $competenceCharacter->setPerso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CaracteristiquePerso>
     */
    public function getCaracteristiquePersos(): Collection
    {
        return $this->caracteristiquePersos;
    }

    public function addCaracteristiquePerso(CaracteristiquePerso $caracteristiquePerso): self
    {
        if (!$this->caracteristiquePersos->contains($caracteristiquePerso)) {
            $this->caracteristiquePersos->add($caracteristiquePerso);
            $caracteristiquePerso->setPerso($this);
        }

        return $this;
    }

    public function removeCaracteristiquePerso(CaracteristiquePerso $caracteristiquePerso): self
    {
        if ($this->caracteristiquePersos->removeElement($caracteristiquePerso)) {
            // set the owning side to null (unless already changed)
            if ($caracteristiquePerso->getPerso() === $this) {
                $caracteristiquePerso->setPerso(null);
            }
        }

        return $this;
    }
}
