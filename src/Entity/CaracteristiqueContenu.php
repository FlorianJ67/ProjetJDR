<?php

namespace App\Entity;

use App\Repository\CaracteristiqueContenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiqueContenuRepository::class)]
class CaracteristiqueContenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isMain = null;

    #[ORM\Column(nullable: true)]
    private ?int $valueMax = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiqueContenus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Caracteristique $caracteristique = null;

    #[ORM\ManyToMany(targetEntity: CollectionCaracteristique::class, inversedBy: 'caracteristiqueContenus')]
    private Collection $collectionCaracteristiques;

    public function __construct()
    {
        $this->collectionCaracteristiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): self
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function getValueMax(): ?int
    {
        return $this->valueMax;
    }

    public function setValueMax(?int $valueMax): self
    {
        $this->valueMax = $valueMax;

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

    /**
     * @return Collection<int, CollectionCaracteristique>
     */
    public function getCollectionCaracteristiques(): Collection
    {
        return $this->collectionCaracteristiques;
    }

    public function addCollectionCaracteristique(CollectionCaracteristique $collectionCaracteristique): self
    {
        if (!$this->collectionCaracteristiques->contains($collectionCaracteristique)) {
            $this->collectionCaracteristiques->add($collectionCaracteristique);
        }

        return $this;
    }

    public function removeCollectionCaracteristique(CollectionCaracteristique $collectionCaracteristique): self
    {
        $this->collectionCaracteristiques->removeElement($collectionCaracteristique);

        return $this;
    }
}
