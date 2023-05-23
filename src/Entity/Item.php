<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $itemValue = null;

    #[ORM\ManyToMany(targetEntity: Character::class, inversedBy: 'items')]
    private Collection $inventaire;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: Action::class)]
    private Collection $actions;

    public function __construct()
    {
        $this->inventaire = new ArrayCollection();
        $this->actions = new ArrayCollection();
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

    public function getItemValue(): ?int
    {
        return $this->itemValue;
    }

    public function setItemValue(?int $itemValue): self
    {
        $this->itemValue = $itemValue;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getInventaire(): Collection
    {
        return $this->inventaire;
    }

    public function addInventaire(Character $inventaire): self
    {
        if (!$this->inventaire->contains($inventaire)) {
            $this->inventaire->add($inventaire);
        }

        return $this;
    }

    public function removeInventaire(Character $inventaire): self
    {
        $this->inventaire->removeElement($inventaire);

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
            $action->setItem($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getItem() === $this) {
                $action->setItem(null);
            }
        }

        return $this;
    }
}
